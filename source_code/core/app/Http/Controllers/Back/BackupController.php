<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;
use ZanySoft\Zip\Zip;

class BackupController extends Controller
{
     /**
     * Constructor Method.
     *
     * Setting Authentication
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }

    
    public function systemBackup()
    {
        $tables = [
            'users', 'subscribers', 'wishlists', 'items', 'galleries', 
            'categories', 'subcategories', 'chield_categories', 'brands', 
            'attributes', 'attribute_options', 'taxes', 'campaign_items', 
            'orders', 'track_orders', 'transactions', 'reviews', 
            'settings', 'posts', 'bcategories'
        ];

        $connect = DB::connection()->getPdo();
        $output = '';

        foreach($tables as $table)
        {
            try {
                $show_table_query = "SHOW CREATE TABLE " . $table . "";
                $statement = $connect->prepare($show_table_query);
                $statement->execute();
                $show_table_result = $statement->fetchAll();

                foreach($show_table_result as $show_table_row)
                {
                    $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                }
                
                $select_query = "SELECT * FROM " . $table . "";
                $statement = $connect->prepare($select_query);
                $statement->execute();
                $total_row = $statement->rowCount();
                
                for($count=0; $count<$total_row; $count++)
                {
                    $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                    $table_column_array = array_keys($single_result);
                    $table_value_array = array_values($single_result);
                    $update = [];
                    foreach($table_value_array as $value){
                        if(is_null($value)) {
                            $update[] = 'NULL';
                        } else {
                            $update[] = "'" . str_replace("'", "\'", $value) . "'";
                        }
                    }
                    
                    $output .= "\nINSERT INTO $table (";
                    $output .= "`" . implode("`, `", $table_column_array) . "`) VALUES (";
                    $output .= "" . implode(",", $update) . ");\n";
                }
            } catch (\Exception $e) {
                // Table might not exist, skip safely
                continue;
            }
        }

        $storage_path = storage_path('app');
        if (!file_exists($storage_path)) {
            mkdir($storage_path, 0755, true);
        }

        $sql_file_name = $storage_path . '/modular_backup_' . date('y-m-d') . '.sql';
        $file_handle = fopen($sql_file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);

        $zip_file = $storage_path . '/' . Carbon::now()->format('Y-m-d-H-i-s').'-modular-backup.zip';
        $zip = new \ZipArchive();
        if ($zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            $zip->addFile($sql_file_name, basename($sql_file_name));
            
            $images_path = realpath(public_path('assets/images'));
            if ($images_path && is_dir($images_path)) {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($images_path),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = 'assets/images/' . substr($filePath, strlen($images_path) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }
            $zip->close();
        }
        
        @unlink($sql_file_name);

        return response()->download($zip_file)->deleteFileAfterSend(true);
    }

    public function databaseBackup()
    {
        $DB_NAME = env('DB_DATABASE');

    $get_all_table_query = "SHOW TABLES ";
    $result = DB::select(DB::raw($get_all_table_query));

    $prep = "Tables_in_$DB_NAME";
    foreach ($result as $res){
        $tables[] =  $res->$prep;
    }

    
    $connect = DB::connection()->getPdo();

    $get_all_table_query = "SHOW TABLES";
    $statement = $connect->prepare($get_all_table_query);
    $statement->execute();
    $result = $statement->fetchAll();


    $output = '';
    foreach($tables as $table)
    {
        $show_table_query = "SHOW CREATE TABLE " . $table . "";
        $statement = $connect->prepare($show_table_query);
        $statement->execute();
        $show_table_result = $statement->fetchAll();

        foreach($show_table_result as $show_table_row)
        {
            $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
        }
        $select_query = "SELECT * FROM " . $table . "";
        $statement = $connect->prepare($select_query);
        $statement->execute();
        $total_row = $statement->rowCount();
        $check = Carbon::now();
        for($count=0; $count<$total_row; $count++)
        {
            $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
            $table_column_array = array_keys($single_result);
            $table_value_array = array_values($single_result);
            $new_value_array = [];
            foreach($table_column_array as $key => $coloumn){
                $new_value_array[] = $table_value_array[$key];
                
                if($coloumn == 'created_at'){
                    
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['created_at'] = Carbon::now()->subMinutes(rand(1, 55));
                    }
                }
                if($coloumn == 'item_type'){
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['item_type'] = 'normal';
                    }
                }
                if($coloumn == 'file_type'){
                    
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['file_type'] = 'file';
                    }
                }
                if($coloumn == 'subcategory_id'){
                    
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['subcategory_id'] = 0;
                    }
                }
                if($coloumn == 'brand_id'){
                    
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['brand_id'] = 0;
                    }
                }
                if($coloumn == 'user_id'){
                    
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['user_id'] = 0;
                    }
                }
                if($coloumn == 'childcategory_id'){
                    
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['childcategory_id'] = 0;
                    }
                }
                if($coloumn == 'updated_at'){
                    if(!$table_value_array[$key]){
                        unset($new_value_array[$key]);
                        $new_value_array['updated_at'] = Carbon::now()->subMinutes(rand(1, 55));
                    }
                }
               
            }
            $update = [];
            foreach($new_value_array as $new_check){
                $update[] = str_replace("'","\'",$new_check);
            }
            
            $output .= "\nINSERT INTO $table (";
            $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
            $output .= "'" . implode("','", $update) . "');\n";
        }
    }
    $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
    $file_handle = fopen($file_name, 'w+');
    fwrite($file_handle, $output);
    fclose($file_handle);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_name));
    flush();
    readfile($file_name);
    unlink($file_name);
    }
}
