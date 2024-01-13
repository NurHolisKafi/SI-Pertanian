<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budidaya extends Model
{
    use HasFactory;
    protected $table = 'budidaya';
    protected $fillable = [
        'tahapan',
        'thumbnail',
        'id_tanaman'
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman');
    }
}
