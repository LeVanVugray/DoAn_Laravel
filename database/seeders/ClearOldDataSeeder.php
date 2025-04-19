<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearOldDataSeeder extends Seeder
{
    public function run()
    {
        // Tắt các ràng buộc khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Xóa dữ liệu trong các bảng sử dụng query builder
        DB::table('products')->delete();
        DB::table('categories')->delete();
        DB::table('manufactures')->delete();
        DB::table('colors')->delete();
        DB::table('users')->delete();
        DB::table('user')->delete();
        DB::table('roles')->delete();
        DB::table('user_role')->delete();

        // Các bảng khác có thể xóa tại đây
        
        // Bật lại các ràng buộc khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

