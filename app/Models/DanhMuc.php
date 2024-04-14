<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'danh_muc';

    protected $guarded = [];

    public function phim(): HasMany
    {
        return $this->hasMany(Phim::class, 'danhmuc_id');
    }
}
