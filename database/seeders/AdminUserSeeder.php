<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ContactRequest;
use App\Models\Product;
class AdminUserSeeder extends Seeder
{
    public function run()
    {
        AdminUser::create([
            'username' => 'admin',
            'password_hash' => Hash::make('admin'), // كلمة المرور: 123456
            'full_name' => 'المشرف الرئيسي',
            'is_active' => true,
        ]);

         Product::factory()->count(20)->create();

        // إنشاء طلبات تواصل تجريبية
        ContactRequest::factory()->count(15)->create();
    }
}