<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKebutuhanTanam extends Model
{
    use HasFactory;
    protected $table = 'detail_kebutuhan_tanam';
    protected $primaryKey = 'id_detail_kebutuhan';
    protected $fillable = [
        'id_kebutuhan',
        'id_tanaman',
        'id_luas',
        'jumlah'
    ];
    public $timestamps = false;
}
