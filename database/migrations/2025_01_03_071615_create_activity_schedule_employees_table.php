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
        Schema::create('activity_schedule_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('activity_schedules_id');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->time('overtime');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_schedule_employees');
    }
};
