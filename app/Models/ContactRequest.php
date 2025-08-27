<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $table = 'contact_requests';
    
    protected $fillable = [
        'full_name',
        'phone',
        'service_type',
        'message',
        'is_read'
    ];
    
    protected $casts = [
        'is_read' => 'boolean',
        'submitted_at' => 'datetime'
    ];
    
    public $timestamps = false;
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->submitted_at = $model->submitted_at ?: now();
        });
    }
}