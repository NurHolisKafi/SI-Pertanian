<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;
    protected $table = 'tanaman';
    protected $primaryKey = 'id_tanaman';
    protected $fillable = [
        'nama'
    ];
    public $timestamps = false;

    public function kebutuhan()
    {
        return $this->belongsToMany(Kebutuhan::class, 'detail_kebutuhan_tanam', 'id_tanaman', 'id_kebutuhan')->withPivot('jumlah');
    }

    public function budidaya()
    {
        return $this->hasOne(Budidaya::class, 'id_tanaman');
    }
}
