<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phim extends Model
{
    use HasFactory;

    protected $table = 'phim';

    protected $guarded = [];

    public function danhMuc()
    {
      return $this->belongsTo(DanhMuc::class, 'danhmuc_id');
    }
}
