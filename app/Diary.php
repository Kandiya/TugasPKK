<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table="diary";
    protected $primaryKey='id';

    protected $fillable = [
        'tanggal', 'judul', 'isi'
    ];
}
