<?php

function storage_image($img): string
{
    $imgName = $img->hashName();
    $image = $img->storeAs('albums/images', $imgName);
    return $image;
}


// get youtube id
if (!function_exists('getYoutubeID')) {
    function getYoutubeID($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = $match[1];
        return $youtube_id;
    }
}

if (!function_exists('getPathImage')) {
    function getPathImage($path)
    {
        if (preg_match('#http|https#', $path)) {
            return $path;
        } else {
            return asset($path);
        }
    }
}

// get youtube id
if (!function_exists('getExtensionPath')) {
    function getExtensionPath($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
}

// get icon lesson
if(!function_exists('getIconLesson')){
    function getIconLesson($lesson)
    {
        switch($lesson->lesson_type){
            case 'video': 
                return '<i class="fas fa-play me-0"></i>';
                break;
            case 'document';
                return '<i class="fas fa-file me-0"></i>';
                break;
            case 'text':
                return '<i class="fas fa-font me-0"></i>';
                break;
        }
    }
}

