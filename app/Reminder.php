<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table="reminder";
    protected $primaryKey='id';

    protected $fillable = [
        'judul', 'deskripsi', 'deadline'
    ];
}
