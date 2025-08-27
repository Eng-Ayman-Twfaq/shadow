<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable // غيّر من Model إلى Authenticatable
{
    use HasFactory;

    protected $table = 'admin_users';
    
    protected $fillable = [
        'username',
        'password_hash', // اسم الحقل كما في قاعدة البيانات
        'full_name',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime'
    ];

    // أضف هذه الدوال المطلوبة للمصادقة
    public function getAuthPassword()
    {
        return $this->password_hash; // لأن الحقل اسمه password_hash وليس password
    }

    public function getUsername()
    {
        return $this->username;
    }
}