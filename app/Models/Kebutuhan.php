<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebutuhan extends Model
{
    use HasFactory;
    protected $table = 'kebutuhan_tanam';
    protected $primaryKey = 'id_kebutuhan';
    protected $fillable = [
        'nama',
        'harga',
        'id_jenis'
    ];
    public $timestamps = false;

    function tanaman()
    {
        return $this->belongsToMany(Tanaman::class, 'detail_kebutuhan_tanam', 'id_kebutuhan', 'id_tanaman')->withPivot('jumlah');
    }
}
