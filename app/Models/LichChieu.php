<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LichChieu extends Model
{
    use HasFactory;

    protected $table = 'lich_chieu';

    protected $guarded = [];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id');
    }

    public function rap()
    {
        return $this->belongsTo(RapPhim::class, 'rap_id');
    }


}
