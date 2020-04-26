<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Buku;
use App\Detail;
use JWTAuth;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DetailController extends Controller
{
    public function report($tgl_awal, $tgl_akhir){
        if(Auth::user()->level=="petugas"){
        $transaksi=DB::table('transaksi')
        ->join('petugas','petugas.id','=','transaksi.id_petugas')
        ->where('transaksi.tgl_transaksi', '>=', $tgl_awal)
        ->where('transaksi.tgl_transaksi', '<=', $tgl_akhir)
        ->select('transaksi.id', 'tgl_transaksi')
        ->get();
  
        $data[]=array(); $no=0;
        foreach ($transaksi as $tr){
          $data[$no]['tgl_transaksi'] = $tr->tgl_transaksi;

          $grand=DB::table('detail')->where('id_transaksi', $tr->id)->groupBy('id_transaksi')
          ->select(DB::raw('sum(subtotal) as grand_total'))->first();

          $data[$no]['grand_total'] = $grand;
          $detail=DB::table('detail')->join('buku','buku.id', '=', 'detail.id_buku')
          ->where('id_transaksi', $tr->id)->select('buku.judul', 'buku.harga_buku', 'detail.qty', 'detail.subtotal')->get();

          $data[$no]['detail'] = $detail;
          $no++;
          }
        
        return response()->json(compact("data"));
      }
    }


}
