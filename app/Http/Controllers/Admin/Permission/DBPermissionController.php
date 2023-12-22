<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DBPermissionController extends Controller
{
    public function dbRole() {
        $items = DB::table('roles')->get();
        $datatables = DataTables::of($items);
        $datatables->editColumn('name', function ($item) {
            $result = $item->name;
            return $result;
        });
        $datatables->editColumn('guard_name', function ($item) {
            return $item->guard_name;
        });
        $datatables->editColumn('description', function ($item) {
            return $item->description;
        });
        $datatables->addColumn('action', function ($item) {
            $permission = '<a href="admin/permission/role?role_id='.$item->id.'" class="btn btn-xs" data-bs-toggle="tooltip" title="Xem quyền">
                    <i class="fa-solid fa-key"></i>
                </a>';
            $watch = '<div class="btn-popover">
                        <div class="btn btn-xs">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </div>
                    </div>';
            $edit = '<div class="btn btn-xs btn-edit-modal" data-bs-toggle="tooltip" title="Sửa nhóm quyền" data-id="'.$item->id.'">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>';
            $delete = '<div class="btn btn-xs btn-destroy" data-bs-toggle="tooltip" title="Xóa nhóm quyền" data-id="'.$item->id.'">
                    <i class="fa-solid fa-trash-can"></i>
                </div>';
            return '<div class="d-flex align-items-center justify-content-center">'. $watch . $permission . $edit . $delete .'</div>';
        });
        $datatables->rawColumns(['action']);
        return $datatables->make();
    }
}
