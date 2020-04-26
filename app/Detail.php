<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table="detail";
    protected $primaryKey='id';

    protected $fillable = [
        'id_buku', 'id_transaksi', 'subtotal', 'qty'
    ];

    public function transaksi(){
        return $this->belongsTo('App/Transaksi', 'id_transaksi');
    }
    public function buku(){
        return $this->belongsTo('App/Buku', 'id_buku');
    }
}
