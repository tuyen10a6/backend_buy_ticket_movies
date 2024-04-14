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
        Schema::create('rap_phim', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_rap');
            $table->string('dia_chi_rap');
            $table->string('sdt');
            $table->integer('suc_chua');
            $table->boolean('trang_thai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rap_phim');
    }
};
