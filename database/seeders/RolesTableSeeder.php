<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    
    public function run(): void
    {
        Roles::truncate();// khi phát hiện có dữ liệu trong CSDL sẽ xóa tất cả đi

        Roles::create(['name'=>'admin']); //Tạo ra tên của cái quyền tương ứng với từng nhân viên
        Roles::create(['name'=>'author']);
        Roles::create(['name'=>'user']);

    }
}
