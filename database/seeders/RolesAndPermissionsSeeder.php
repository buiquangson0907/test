<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['guard_name' => 'admin','name' => 'super','description' => 'super account', 'sort' => '1']);
        Permission::create(['guard_name' => 'admin','name' => 'super-index', 'description' => 'Xem Tài khoản']);
        Permission::create(['guard_name' => 'admin','name' => 'super-add','description' => 'Tạo Tài khoản']);
        Permission::create(['guard_name' => 'admin','name' => 'super-edit','description' => 'Sửa tài khoản']);
        Permission::create(['guard_name' => 'admin','name' => 'super-publish','description' => 'công bố tài khoản']);
        Permission::create(['guard_name' => 'admin','name' => 'super-delete', 'description' => 'Xóa tài khoản']);
        $account = Admin::find(1);
        $account->assignRole('super');


        Role::create(['guard_name' => 'admin','name' => 'product','description' => 'Sản phẩm', 'sort' => '2']);
        Permission::create(['guard_name' => 'admin','name' => 'product-index', 'description' => 'Xem Sản phẩm']);
        Permission::create(['guard_name' => 'admin','name' => 'product-add','description' => 'Tạo Sản phẩm']);
        Permission::create(['guard_name' => 'admin','name' => 'product-edit','description' => 'Sửa Sản phẩm']);
        Permission::create(['guard_name' => 'admin','name' => 'product-delete', 'description' => 'Xóa Sản phẩm']);

        Permission::create(['guard_name' => 'admin','name' => 'sale-index', 'description' => 'Xem Bán hàng']);
        Permission::create(['guard_name' => 'admin','name' => 'sale-add','description' => 'Tạo Bán hàng']);
        Permission::create(['guard_name' => 'admin','name' => 'sale-edit','description' => 'Sửa Bán hàng']);
        Permission::create(['guard_name' => 'admin','name' => 'sale-delete', 'description' => 'Xóa Bán hàng']);


        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
