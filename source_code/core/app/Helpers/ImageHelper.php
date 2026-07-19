<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Image;

class ImageHelper
{
    public static function convertUploadedAvifToWebp($file)
    {
        if (!$file || !($file instanceof \Illuminate\Http\UploadedFile) || strtolower($file->getClientOriginalExtension()) !== 'avif') {
            return $file;
        }

        $tempPath = $file->getRealPath();
        $newTempPath = $tempPath . '_converted.webp';
        $newOriginalName = preg_replace('/\.avif$/i', '.webp', $file->getClientOriginalName());
        $success = false;

        // Try PHP native GD (PHP 8.1+)
        if (function_exists('imagecreatefromavif') && function_exists('imagewebp')) {
            $image = @imagecreatefromavif($tempPath);
            if ($image) {
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                $success = imagewebp($image, $newTempPath, 90);
                imagedestroy($image);
            }
        }

        // Try Imagick fallback
        if (!$success && extension_loaded('imagick') && class_exists('\Imagick')) {
            try {
                $imagick = new \Imagick($tempPath);
                $imagick->setImageFormat('webp');
                $imagick->setImageCompressionQuality(90);
                $success = $imagick->writeImage($newTempPath);
                $imagick->clear();
                $imagick->destroy();
            } catch (\Exception $e) {
                // Ignore
            }
        }

        // Try ffmpeg fallback
        if (!$success) {
            $output = [];
            $return_var = -1;
            exec("command -v ffmpeg", $output, $return_var);
            if ($return_var === 0) {
                exec("ffmpeg -y -i " . escapeshellarg($tempPath) . " -c:v libwebp -lossless 0 -q:v 90 " . escapeshellarg($newTempPath) . " 2>&1", $out, $ret);
                if ($ret === 0 && file_exists($newTempPath)) {
                    $success = true;
                }
            }
        }

        // Try avifdec (libavif-bin) fallback
        if (!$success) {
            $output = [];
            $return_var = -1;
            exec("command -v avifdec", $output, $return_var);
            if ($return_var === 0) {
                $tempPng = $tempPath . '.png';
                exec("avifdec " . escapeshellarg($tempPath) . " " . escapeshellarg($tempPng) . " 2>&1", $out, $ret);
                if ($ret === 0 && file_exists($tempPng)) {
                    if (function_exists('imagecreatefrompng') && function_exists('imagewebp')) {
                        $image = @imagecreatefrompng($tempPng);
                        if ($image) {
                            imagepalettetotruecolor($image);
                            imagealphablending($image, true);
                            imagesavealpha($image, true);
                            $success = imagewebp($image, $newTempPath, 90);
                            imagedestroy($image);
                        }
                    }
                    @unlink($tempPng);
                }
            }
        }

        if ($success && file_exists($newTempPath)) {
            @unlink($tempPath); // delete original avif from temp storage
            return new \Illuminate\Http\UploadedFile(
                $newTempPath,
                $newOriginalName,
                'image/webp',
                null,
                true // test mode to allow moving the fake uploaded file
            );
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'photo' => 'Failed to convert AVIF image to WebP. Your server might not support AVIF decoding (Requires GD PHP 8.1+, ffmpeg, or libavif-bin). Please try uploading a JPG or PNG instead.'
        ]);
    }

    public static function handleUploadedImage($file,$path,$delete=null) {
        if ($file) {
            $file = self::convertUploadedAvifToWebp($file);
            if($delete){
                
                if (file_exists(base_path('../').$path.'/'.$delete)) {
                    unlink(base_path('../').$path.'/'.$delete);
                }
            }
            $name = Str::random(4).$file->getClientOriginalName();
            $file->move($path,$name);
            return $name;
        }
    }
    public static function ItemhandleUploadedImage($file,$path,$delete=null) {
        if ($file) {
            $file = self::convertUploadedAvifToWebp($file);
            if($delete){
                if (file_exists(base_path('../').$path.'/'.$delete)) {
                    unlink(base_path('../').$path.'/'.$delete);
                }
            }

            $thum = Str::random(8).'.'.$file->getClientOriginalExtension();
            $image = \Image::make($file)->resize(230,230);
    
            $image->save(base_path('../').$path.'/'.$thum);
    
            $photo = time().$file->getClientOriginalName();
            $file->move($path,$photo);
            return [$photo,$thum];
        }
    }

    public static function handleUpdatedUploadedImage($file,$path,$data,$delete_path,$field) {
        $file = self::convertUploadedAvifToWebp($file);
        $name = time().$file->getClientOriginalName();
   
        $file->move(base_path('..').$path,$name);
        if($data[$field] != null){
            if (file_exists(base_path('../').$delete_path.$data[$field])) {
                unlink(base_path('../').$delete_path.$data[$field]);
            }
        }
        return $name;
    }


    public static function ItemhandleUpdatedUploadedImage($file,$path,$data,$delete_path,$field) {
        $file = self::convertUploadedAvifToWebp($file);
        $photo = time().$file->getClientOriginalName();
        $thum = Str::random(8).'.'.$file->getClientOriginalExtension();
      
        $image = \Image::make($file)->resize(230,230);

        $image->save(base_path('..').$path.'/'.$thum);

        $file->move(base_path('..').$path,$photo);

        if($data['thumbnail'] != null){
            if (file_exists(base_path('../').$delete_path.$data['thumbnail'])) {
                unlink(base_path('../').$delete_path.$data['thumbnail']);
            }
        }
        if($data[$field] != null){
            if (file_exists(base_path('../').$delete_path.$data[$field])) {
                unlink(base_path('../').$delete_path.$data[$field]);
            }
        }
        return [$photo,$thum];
    }


    public static function handleDeletedImage($data,$field,$delete_path) {
        
        
        if($data[$field] != null){
            if (file_exists(base_path('../').$delete_path.$data[$field])) {
                unlink(base_path('../').$delete_path.$data[$field]);
            }
        }
    }
}
