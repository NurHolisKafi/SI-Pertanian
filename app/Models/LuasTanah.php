<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuasTanah extends Model
{
    use HasFactory;
    protected $table = 'luas_tanah';
    protected $primaryKey = 'id_luas';
    protected $fillable = [
        'luas',
    ];
    public $timestamps = false;

    function HasilPerhitungan()
    {
        return $this->hasMany(HasilPerhitungan::class, 'id_luas');
    }
}
