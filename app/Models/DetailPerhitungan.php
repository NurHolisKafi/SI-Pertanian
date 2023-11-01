<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerhitungan extends Model
{
    use HasFactory;
    protected $table = 'detail_hasil_perhitungan';
    protected $primaryKey = 'id_detail_perhitungan';
    protected $fillable = [
        'id_perhitungan',
        'id_bahan',
    ];
    public $timestamps = false;
}
