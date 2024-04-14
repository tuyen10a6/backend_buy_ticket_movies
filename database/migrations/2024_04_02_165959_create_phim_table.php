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
        Schema::create('phim', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_phim');
            $table->string('dao_dien')->nullable();
            $table->date('ngay_phat_hanh')->nullable();
            $table->unsignedInteger('danhmuc_id');
            $table->foreign('danhmuc_id')->references('id')->on('danh_muc');
             // tinh theo phut
            $table->string('thoi_luong')->nullable();
            $table->text('tom_tat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phim');
    }
};
