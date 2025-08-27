<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 255);
            $table->text('description_ar')->nullable();
            $table->enum('category', ['curtain', 'canopy', 'hanger', 'other']);
            $table->string('type', 100);
            $table->string('price', 100);
            $table->string('price_label', 100)->nullable();
            $table->string('warranty', 100)->nullable();
            $table->string('tags', 255)->nullable();
            $table->string('image_url', 255);
            $table->string('badge_text', 100);
            $table->text('whatsapp_message');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('type');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};