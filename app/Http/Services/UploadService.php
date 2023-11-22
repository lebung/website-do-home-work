<?php

namespace App\Http\Services;

class UploadService{

    public static function upload($file, $prefix, $type = null){

        if(!isset($file)) return null;
        
        $fileName = $prefix . '_' . $file->hashName();

        if(!$type){
            $filePath = $file->storeAs('images/' . $prefix, $fileName);
        } else {
            $filePath = $file->storeAs($type.'/'. $prefix, $fileName);
        }

        return $filePath;
    }

}