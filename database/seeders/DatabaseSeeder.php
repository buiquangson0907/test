<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $data = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'admin',
                'password' => bcrypt('secret'),
                'role' => 1,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'email' => 'vohungnghiem@gmail.com',
                'name' => 'nhân viên',
                'password' => bcrypt('secret'),
                'role' => 2,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];
        DB::table('admins')->insert($data);
    }
}

