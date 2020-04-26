<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table="mapel";
    protected $primaryKey='id';

    protected $fillable = [
        'nama_mapel', 'waktu', 'guru', 'hari'
    ];
}
