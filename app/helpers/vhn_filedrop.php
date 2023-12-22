<?php
function vhn_formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}
class FileDrop
{
    public static function fileDropArea($name, $id, $type)
    {
        return '<div class="file-drop-area">
        <div class="drop-area">
        <span class="fake-btn"><i class="fa-solid fa-image"></i> Choose files</span>
        <span class="file-msg">or drop files here</span>
        <input class="dropfile" name="' . $name . '" id="' . $id . '" type="file" ' . $type . '>
        </div>
        </div>';
    }
    public static function show($image, $id)
    {
        if ($image) {
            echo '<div class="wrap-item">';
            echo '<div class="image-item">';
            echo '<img src="storage/' . $image . '?v=' . time() . '" class="preview" alt="">';
            echo '</div>';
            echo '<div class="left-item">';
            echo '<p class="title-file">' . $image . '</p>';
            echo  '<small>';
            if (File::exists('storage/' . $image)) {
                echo   vhn_formatSizeUnits(File::size('storage/' . $image));
            }
            echo  '</small>';
            echo  '<span class="remove-file removeHasFile" data-id="' . $id . '">';
            echo ' <i class="fa-solid fa-trash-can"></i>';
            echo ' </span>';
            echo '</div>';
            echo '</div>';
        }
    }
}
