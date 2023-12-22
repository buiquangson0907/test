<?php

namespace App\Services;

use File;
class DataTableService
{
    public static function showImage($image)
    {
        if ($image && File::exists('storage/' . $image)){
            return '<img src="storage/'.$image.'?v='.time().'" class="db-img" alt="image"
                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top" data-bs-html="true"
                data-bs-content="<img class=\'popover-img\' src=\'storage/'.$image.'?v='.time().'\' >"
            >';
        }
            return '<i class="fa-regular fa-image"></i>';
    }

    public static function showStatus($id,$status)
    {
        $checked = ($status == 1) ? 'checked' : '';
        return '<label class="btn-status" data-id="'.$id.'" data-status="'.$status.'" for="status'.$id.'"></lable>'.
                '<input type="checkbox" id="status'.$id.'" ' . $checked. '
                data-toggle="toggle" data-size="xs" data-width="70"
                data-on="Đã mở" data-off="Đã tắt" data-onstyle="primary" data-offstyle="secondary">';
    }

    public static function showStatusDisabled($id,$status)
    {
        $checked = ($status == 1) ? 'checked' : '';
        return '<label for="status'.$id.'"></lable>'.
            '<input type="checkbox" id="status'.$id.'" ' . $checked. ' disabled
            data-toggle="toggle" data-size="xs" data-width="70"
            data-on="Đã mở" data-off="Đã tắt" data-onstyle="warning" data-offstyle="secondary">';
    }

    public static function showEdit($href)
    {
        return '<a href="'.$href.'" data-bs-toggle="tooltip" title="Chỉnh sửa" class="btn btn-xs">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>';
    }

    public static function showEditDisabled()
    {
        return '<div class="badge text-warning"> <i class="fa-solid fa-pen-to-square"></i> </div>';
    }

    public static function showDelete($id)
    {
        return '<div data-bs-toggle="tooltip" title="xóa khỏi hệ thống" class="btn btn-xs btn-destroy mx-1" data-id="'.$id.'">
            <i class="fa-solid fa-trash-can"></i>
        </div>';
    }

}
