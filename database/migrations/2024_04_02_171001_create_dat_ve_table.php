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
        Schema::create('dat_ve', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lich_chieu_id')->nullable();
            $table->foreign('lich_chieu_id')->references('id')->on('lich_chieu');
            $table->string('ten_khachhang');
            $table->string('sdt');
            $table->string('email')->nullable();
            $table->dateTime('thoi_gian_dat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dat_ve');
    }
};
