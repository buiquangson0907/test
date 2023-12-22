<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Admin\Account\ServiceAccount;

class AccountController extends Controller
{
    const MODEL = "App\Models\Admin";

    public function index()
    {
        return view('admin.account.index');
    }

    protected function saveData($request,$account)
    {
        if ($request->name != $request->oldname) {
            $account->name = $request->name;
        }
        if ($request->email != $request->oldemail) {
            $account->email = strtolower($request->email);
        }
        if ($request->password != null) {
            $account->password = bcrypt($request->password);
        }
        $account->phone = str_replace('.','',$request->phone);
        $account->status = $request->status == 'on' ? 1 : 0;
        if (ServiceAccount::isVerifyRequestRole($request->role)) {
            $account->role = $request->role;
        }

        return $account;
    }

    public function create()
    {
        $roles = Role::get();
        return ServiceAccount::isVerifyCreate() ?
            view('admin.account.create',compact('roles')) :
            redirect()->back()->with('permission','không có quyền');
    }
    public function store(AccountRequest $request)
    {
        if (ServiceAccount::isVerifyCreate()) {
            $account = new Admin;
            $this->saveData($request,$account);
            $account->creator = auth()->guard('admin')->user()->id;
            $account->created_at = date("Y-m-d H:i:s");
            $account->avatar = ServiceAccount::saveImage($request,$account);
            $account->save();

            if (auth()->guard('admin')->user()->hasAnyRole('super') && $request->role_id) {
                DB::table('model_has_roles')->updateOrInsert(
                    ['model_id' => $account->id, 'model_type' => self::MODEL],
                    ['role_id' => $request->role_id]
                );
            }
            return redirect('admin/account/edit/'.$account->id)->with('success','Đã thêm thành công, xem lại thông tin trước khi rời đi!');
        }else{
            return redirect()->back()->with('permission','không có quyền');
        }
    }

    public function edit($id)
    {
        $account = Admin::find($id);
        $roles = Role::get();
        $role_model = DB::table('model_has_roles')->where(['model_id' => $account->id, 'model_type' => self::MODEL])->first();
        $role_id = $role_model ? $role_model->role_id : 0;
        if ( ServiceAccount::isVerifyEdit($account))
        {
            return view('admin.account.edit',compact('account','roles','role_id'));
        }
        return redirect()->back()->with('permission','không có quyền');
    }
    public function update(AccountRequest $request, $id)
    {
        try {
            $account = Admin::find($id);
            if ( ServiceAccount::isVerifyEdit($account))
            {
                $account->avatar = ServiceAccount::saveImage($request,$account);
                $this->saveData($request,$account);
                $account->updated_at = date("Y-m-d H:i:s");
                $account->save();
                if (auth()->guard('admin')->user()->hasAnyRole('super') && $request->role_id) {
                    DB::table('model_has_roles')->updateOrInsert(
                        ['model_id' => $account->id, 'model_type' => self::MODEL],
                        ['role_id' => $request->role_id]
                    );
                }else {
                    DB::table('model_has_roles')->where(['model_id' => $account->id, 'model_type' => self::MODEL])->delete();
                }
                return redirect('admin/account/edit/'.$id)->with('success','Chỉnh sửa tài khoản thành công!');
            }
            return redirect()->back()->with('permission','không có quyền');
        } catch (\Throwable $th) {
            return redirect('admin/account/edit/'.$id)->with('error','Thông báo lỗi');
        }
    }

    public function status(Request $request)
    {
        try {
            $account = Admin::find($request->id);

            if (ServiceAccount::isVerifyPublish($account->role))
            {
                $account->status = ($request->status == 1) ? 0 : 1;
                $account->save();
                return response()->json('success');
            }
            return response()->json('permission');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $account = Admin::find($request->id);
            if (ServiceAccount::isVerifyDestroy($account))
            {
                ServiceAccount::deleteFile($account->avatar);
                $account->delete();
                return response()->json('success');
            }
            else{
                return response()->json('permission');
            }
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function getPassword()
    {
        $account = Admin::find(auth()->guard('admin')->user()->id);
        return view('admin.account.password',compact('account'));
    }
    public function postPassword(PasswordRequest $request)
    {
        $account = Admin::find(auth()->guard('admin')->user()->id);
        $account->password = bcrypt($request->password);
        $account->save();
        return redirect()->back()->with('success','Mật khẩu thay đổi thành công!');
    }
}
