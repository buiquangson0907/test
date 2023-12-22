<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\GroupPermission;
use App\Models\Admin;
class RolePermissionController extends Controller
{
    const MODEL = "App\Models\Admin";
    const GUARD_NAME = "admin";
    public function getModel() {
        $model_id = ( isset($_GET['model_id']) != null ) ? $_GET['model_id'] : auth()->guard('admin')->user()->id;
        $role_id = ( isset($_GET['role_id']) != null ) ? $_GET['role_id'] : NULL;
        $models = Admin::leftJoin('model_has_roles','model_has_roles.model_id','=','admins.id')
            ->select('admins.*','model_has_roles.model_id')
            ->get();
        $model = Admin::leftJoin('model_has_roles','model_has_roles.model_id','=','admins.id')
            ->where('model_has_roles.model_type',self::MODEL)
            ->where('admins.id',$model_id)
            ->select('admins.id','admins.name','admins.email','model_has_roles.role_id')
            ->first();
        try {
            $model->id;
            $sqlRoleChecked = DB::table('model_has_roles')->where('model_id',$model_id)->pluck("role_id")->implode(",");
            if ($role_id) {
                $modelroles = DB::table('roles')
                    ->select('roles.*', DB::raw('(CASE WHEN '.DB::getTablePrefix().'roles.id = ' . $role_id . ' THEN 1 ELSE 0 END) AS role_id'))
                    ->get();
            }else{
                $modelroles = DB::table('roles')
                    ->leftJoin('model_has_roles','model_has_roles.role_id','roles.id')
                    ->select( 'roles.*', DB::raw(' (CASE WHEN FIND_IN_SET(role_id, "'.$sqlRoleChecked.'") THEN true END) AS role_id') )
                    ->get()->unique('id');
            }
            $sqlPermissionChecked = DB::table('model_has_permissions')->where('model_id',$model_id)->pluck("permission_id")->implode(",");
            if ($role_id) {
                $sqlRoldPermissionChecked = DB::table('role_has_permissions')
                ->where('role_has_permissions.role_id',$role_id)
                ->pluck("role_has_permissions.permission_id")->implode(",");
            }else{
                $sqlRoldPermissionChecked = DB::table('role_has_permissions')
                ->join('model_has_roles','model_has_roles.role_id','=','role_has_permissions.role_id')
                ->where('model_has_roles.model_id',$model_id)
                ->pluck("role_has_permissions.permission_id")->implode(",");
            }
            $modelpermissions = GroupPermission::leftJoin('permissions','permissions.group_permission','=','group_permissions.name')
                ->leftJoin('model_has_permissions','model_has_permissions.permission_id','permissions.id')
                ->leftJoin('role_has_permissions','role_has_permissions.permission_id','permissions.id')
                ->select( 'permissions.*','role_has_permissions.role_id',
                    DB::raw(' (CASE WHEN FIND_IN_SET('.DB::getTablePrefix().'model_has_permissions.permission_id, "'.$sqlPermissionChecked.'") THEN true END) AS permission_id'),
                    DB::raw(' (CASE WHEN FIND_IN_SET('.DB::getTablePrefix().'role_has_permissions.permission_id, "'.$sqlRoldPermissionChecked.'") THEN true END) AS role_permission'),
                    DB::raw('CONCAT('.DB::getTablePrefix().'group_permissions.name,"-",'.DB::getTablePrefix().'group_permissions.description) as group_permission'),
                )
                ->get()->unique('id')->groupBy('group_permission');
            return view('admin.permission.model',compact('models','model','modelroles' ,'modelpermissions' ));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Tài khoản chưa được phân quyền!');
        }
    }
    public function postModel(Request $request) {
        try {
            $model = Admin::find($request->model_id);
            if ($request->model_id == 1) {
                $model->assignRole('super');
                return redirect()->back()->with('error','Tài khoản <b> '.$model->name.' </b> không được thay đổi!');
            }else{
                DB::table('model_has_roles')->where('model_id',$request->model_id)->delete();
                if ($request->check_role) {
                    $role = $request->check_role;
                    $model->assignRole($role);
                }
            }
            DB::table('model_has_permissions')->where('model_id',$request->model_id)->delete();
            if ($request->check_permission) {
                $permission = array_keys($request->check_permission);
                $model->givePermissionTo($permission);
            }
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            return redirect()->back()->with('success','Đã thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Có 1 thao tác lỗi cần kiểm tra!');
        }
    }
    public function getRole() {
        $role_id = ( isset($_GET['role_id']) != null) ? $_GET['role_id'] : 1;
        $role = Role::find($role_id);
        $roles = Role::all();
        $sqlChecked = DB::table('role_has_permissions')->where('role_id',$role_id)->pluck("permission_id")->implode(",");
        $permissions = Permission::leftJoin('group_permissions','group_permissions.name','=','permissions.group_permission')
            ->leftJoin('role_has_permissions','role_has_permissions.permission_id','permissions.id')
            ->select('permissions.*',
                DB::raw('CONCAT('.DB::getTablePrefix().'group_permissions.name,"-",'.DB::getTablePrefix().'group_permissions.description) as group_permission'),
                DB::raw(' (CASE WHEN FIND_IN_SET(permission_id, "'.$sqlChecked.'") THEN true END) AS permission_id'))
            ->get()->unique('id')->groupBy('group_permission');
        return view('admin.permission.role',compact('roles','role','permissions'));
    }
    public function postRole(Request $request) {
        $role = Role::find($request->role_id);
        DB::table('role_has_permissions')->where('role_id',$request->role_id)->delete();
        if ($request->check_permission) {
            $role->givePermissionTo(array_keys($request->check_permission));
        }
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        return redirect()->back()->with('success','Đã thành công!');
    }

    public function storeGroupPermission(PermissionRequest $request)
    {
        $group = new GroupPermission();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->sort = $request->sort;
        $group->save();
        return redirect()->back()->with('success','Đã thành công!');
    }
    public function ajaxGroupPermission($group_id)
    {
        $group_permission = DB::table('group_permissions')->where('group_permissions.name',$group_id)->first();
        return response()->json($group_permission);
    }
    public function updateGroupPermission(PermissionRequest $request, $group_id)
    {
        $group = GroupPermission::where('name',$group_id);
        $group->update([ 'description' => $request->description, 'sort' => $request->sort]);
        return redirect()->back()->with('success','Đã thành công!');
    }

    public function getGroupPermission($permission_id)
    {
        $permission = Permission::find($permission_id);
        $group_permission = GroupPermission::select('group_permissions.*',
            DB::raw("'{$permission->group_permission}' as current"),
            DB::raw("'{$permission->description}' as permission_description"))
            ->orderBy('sort','asc')->get();
        return response()->json($group_permission);
    }
    public function removeGroupPermission($remove) {
        GroupPermission::where('name',$remove)->delete();
        return response()->json('success');
    }
    public function postGroupPermission(Request $request,$permission_id)
    {
        $group = Permission::where('id',$permission_id);
        $group->update([ 'group_permission' => $request->move]);
        return redirect()->back()->with('success','Đã thành công!');
    }
}
