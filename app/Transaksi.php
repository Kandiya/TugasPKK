<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table='transaksi';
    protected $primaryKey='id';
    
    protected $fillable = [
        'id_petugas', 'tgl_transaksi'
    ];

    public function petugas(){
        return $this->belongsTo('App/Petugas', 'id_petugas');
    }
    public function detail(){
        return $this->hasMany('App/Detail', 'id');
}
}