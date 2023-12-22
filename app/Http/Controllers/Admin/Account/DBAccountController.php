<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Admin\Account\ServiceAccount;
use App\Services\DataTableService;
class DBAccountController extends Controller
{
    function __construct(ServiceAccount $service)
    {
        $this->service = $service;
    }
    public function datatableAccount() {
        $role = 1;
        $item = DB::table('admins')
            ->where('admins.role','>=',$role)->orderBy('admins.id','desc');
        $datatables = DataTables::of($item);
        $datatables->editColumn('email', function ($item) {
            $result = $item->email;
            return $result;
        });
        $datatables->editColumn('avatar', function ($item) {
            return DataTableService::showImage($item->avatar);
        });
        $datatables->editColumn('status', function ($item) {
            $status = DataTableService::showStatusDisabled($item->id,$item->status);
            if ( ServiceAccount::isVerifyPublish($item->role))
            {
                $status = DataTableService::showStatus($item->id,$item->status);
            }
            return $status;
        });
        $datatables->addColumn('action', function ($item) {
            $result = ''; $delete = '';
            $permission = '<a href="admin/permission/model?model_id='.$item->id.'" class="btn btn-xs" data-bs-toggle="tooltip" title="Xem quyền">
                    <i class="fa-solid fa-key"></i>
                </a>';
            $edit = DataTableService::showEditDisabled();
            if (ServiceAccount::isVerifyEdit($item))
            {
                $edit = DataTableService::showEdit('admin/account/edit/'.$item->id);
            }
            if (ServiceAccount::isVerifyDestroy($item))
            {
                $delete = DataTableService::showDelete($item->id);
            }
            $result .= '<div class="d-flex">'. $edit . $permission . $delete .'</div>';
            return $result;
        });
        $datatables->rawColumns(['email','avatar','status','action']);
        return $datatables->make();
    }
}
