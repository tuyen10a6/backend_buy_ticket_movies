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
        Schema::create('lich_chieu', function (Blueprint $table) {
            $table->increments('id');
            // Unsigned là để hiểu không chứa giá trị âm
            $table->unsignedInteger('phim_id')->nullable();
            $table->foreign('phim_id')->references('id')->on('phim');
            $table->unsignedInteger('rap_id')->nullable();
            $table->foreign('rap_id')->references('id')->on('rap_phim');
            $table->dateTime('thoi_gian_bat_dau')->nullable();
            $table->dateTime('thoi_gian_ket_thuc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_chieu');
    }
};
