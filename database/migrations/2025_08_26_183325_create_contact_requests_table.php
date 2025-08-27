<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255);
            $table->string('phone', 20);
            $table->string('service_type', 100);
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('submitted_at')->useCurrent();
            
            $table->index('submitted_at');
            $table->index('is_read');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_requests');
    }
};