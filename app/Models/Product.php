<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'name_ar',
        'description_ar',
        'category',
        'type',
        'price',
        'price_label',
        'warranty',
        'tags',
        'image_url',
        'badge_text',
        'whatsapp_message',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    public function getCategoryNameAttribute()
    {
        $categories = [
            'curtain' => 'ستائر',
            'canopy' => 'مظلات',
            'hanger' => 'هانجر',
            'other' => 'أخرى'
        ];
        
        return $categories[$this->category] ?? $this->category;
    }
}