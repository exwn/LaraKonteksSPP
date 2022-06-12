<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spp extends Model
{
    use SoftDeletes;

    protected $table = 'spp';

    protected $fillable = [
        'user_id',
        'transaksi_id',
        'total',
        'is_lunas',
        'keterangan'
    ];

    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi', 'id', 'transaksi_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\user', 'id', 'user_id');
    }
}
