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

    
    public function index()
    {
        return view('back.backup.index');
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
                    $output .= "\n\nDROP TABLE IF EXISTS `" . $table . "`;\n";
                    $output .= $show_table_row["Create Table"] . ";\n\n";
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

        $sql_file_name = $storage_path . '/database_backup_' . Carbon::now()->format('Y-m-d-H-i-s') . '.sql';
        $file_handle = fopen($sql_file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);

        return response()->download($sql_file_name)->deleteFileAfterSend(true);
    }

    public function systemRestore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        $file = $request->file('backup_file');
        
        if ($file->getClientOriginalExtension() != 'sql') {
            return back()->with('error', __('Please upload a valid .sql file.'));
        }

        try {
            DB::unprepared(file_get_contents($file->getRealPath()));
            return back()->with('success', __('System restored successfully.'));
        } catch (\Exception $e) {
            return back()->with('error', __('Error restoring system: ') . $e->getMessage());
        }
    }

}
