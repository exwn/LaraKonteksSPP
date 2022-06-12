<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'nama',
        'jumlah',
        'wajib_semua',
        'kelas_id',
    ];

    public function user()
    {
        return $this->belongsToMany('App\Models\User', 'role');
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id', 'kelas_id');
    }

    // public function getJumlahIdrAttribute()
    // {
    //     return "IDR. " . format_idr($this->jumlah);
    // }
}
