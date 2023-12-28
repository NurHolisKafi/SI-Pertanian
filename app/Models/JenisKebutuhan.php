<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKebutuhan extends Model
{
    use HasFactory;
    protected $table = 'jenis_kebutuhan';
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'kategori',
    ];
    public $timestamps = false;
}
