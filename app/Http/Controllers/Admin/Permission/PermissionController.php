<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use Spatie\Permission\Models\Role;
use App\Http\Requests\PermissionRequest;
class PermissionController extends Controller
{
    const MODEL = "App\Models\Admin";
    const GUARD_NAME = "admin";
    public function index() {
        return view('admin.permission.index');
    }
    public function ajaxRoleAccount($id) {
        $accounts = DB::table('model_has_roles')
            ->join('admins','admins.id','=','model_has_roles.model_id')
            ->where('model_has_roles.role_id',$id)
            ->where('model_has_roles.model_type',self::MODEL)
            ->select('admins.name','admins.email','model_has_roles.model_id')
            ->get();
        return response()->json($accounts);
    }
    public function ajaxRole($role_id)
    {
        $role = DB::table('roles')->where('roles.id',$role_id)->first();
        return response()->json($role);
    }
    public function storeRole(PermissionRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = self::GUARD_NAME;
        $role->description = $request->description;
        $role->sort = $request->sort;
        $role->save();
        return redirect()->back()->with('success','Đã thành công!');
    }
    public function updateRole(PermissionRequest $request,$role_id)
    {
        $role = Role::find($role_id);
        if ($role->id != 1) {
            $role->name = $request->name;
        }
        $role->guard_name = self::GUARD_NAME;
        $role->description = $request->description;
        $role->sort = $request->sort;
        $role->save();
        if ($role->id == 1) {
            return redirect()->back()->with('permission','không được đổi tên nhóm!');
        }
        return redirect()->back()->with('success','Đã thành công!');
    }
    public function destroy(Request $request)
    {
        try {
            $role = Role::find($request->id);
            if ($role->id != 1) {
                $role->delete();
                return response()->json('success');
            }else{
                return response()->json('permission');
            }
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }

}
