<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('activity_date');
            $table->time('activity_time');
            $table->string('No_OP')->nullable();
            $table->enum('order', ['kerjasama', 'walkin', 'online', 'reserve'])->default('walkin');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('products_id');
            $table->enum('status', ['pending', 'done', 'cancel', 'confirmed'])->default('pending');
            $table->foreignId('users_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_schedules');
    }
};
