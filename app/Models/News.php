<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $primaryKey = 'id_berita';
    protected $fillable = [
        'judul',
        'isi_berita',
        'thumbnail',
        'tanggal_posting',
    ];
    public $timestamps = false;
}
