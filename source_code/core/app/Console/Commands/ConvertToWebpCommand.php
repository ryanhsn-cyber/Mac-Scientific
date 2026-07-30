<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Gallery;

class ConvertToWebpCommand extends Command
{
    protected $signature = 'images:convert-webp';
    protected $description = 'Convert all existing images to WebP and update the database';

    public function handle()
    {
        $this->info("Starting WebP Conversion...");
        $models = [
            Item::class => ['photo', 'thumbnail'],
            Category::class => ['photo'],
            Brand::class => ['photo'],
            Slider::class => ['photo', 'logo'],
            Setting::class => ['logo', 'favicon', 'loader', 'discount_banner'],
            Post::class => ['photo'],
            User::class => ['photo'],
            Admin::class => ['photo'],
            Service::class => ['photo'],
            Gallery::class => ['photo'],
            \App\Models\Subcategory::class => ['photo'],
            \App\Models\ChieldCategory::class => ['photo'],
            \App\Models\Bcategory::class => ['photo'],
            \App\Models\Fcategory::class => ['photo'],
            \App\Models\HomeCutomize::class => ['banner_image1','banner_image2','banner_image3','banner_image4','banner_image5','banner_image6']
        ];

        foreach ($models as $modelClass => $columns) {
            if (!class_exists($modelClass)) {
                continue;
            }

            $this->info("Processing $modelClass");
            try {
                $records = $modelClass::all();
            } catch (\Exception $e) {
                $this->error("Failed to fetch records for $modelClass: " . $e->getMessage());
                continue;
            }

            foreach ($records as $record) {
                foreach ($columns as $column) {
                    $originalFile = $record->{$column};
                    if (!$originalFile || empty($originalFile) || !is_string($originalFile)) continue;

                    // If it is already webp, skip
                    if (preg_match('/\.webp$/i', $originalFile)) continue;

                    // Try different possible paths
                    $pathsToTry = [
                        base_path('../assets/images/'),
                        base_path('../assets/front/'),
                        base_path('../assets/files/'),
                        base_path('../assets/front/images/'),
                        base_path('../assets/front/images/banners/'),
                    ];

                    $foundPath = null;
                    foreach ($pathsToTry as $path) {
                        if (file_exists($path . $originalFile)) {
                            $foundPath = $path;
                            break;
                        }
                    }

                    if ($foundPath) {
                        $fullPath = $foundPath . $originalFile;
                        
                        try {
                            $image = \Image::make($fullPath);
                            
                            $newFilename = pathinfo($originalFile, PATHINFO_FILENAME) . '_' . time() . '.webp';
                            $newFullPath = $foundPath . $newFilename;
                            
                            $image->encode('webp', 90)->save($newFullPath);
                            $image->destroy();
                            
                            $record->{$column} = $newFilename;
                            $record->save();
                            
                            // Delete original file
                            @unlink($fullPath);
                            
                            $this->line("Converted: $originalFile -> $newFilename");
                        } catch (\Exception $e) {
                            $this->error("Failed to convert $originalFile: " . $e->getMessage());
                        }
                    }
                }
            }
        }
        
        $this->info("WebP Conversion Complete!");
    }
}
