<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Petugas;
use App\Transaksi;
use App\Detail;
use JWTAuth;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
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



    public function store(Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Transaksi::create([
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi
        ]);
        if($simpan){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Transaksi::where('id', $id)->update([
            
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }
    public function hapus($id){
        if(Auth::user()->level=="petugas"){
        $hapus=Transaksi::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}

//detail_pinjam

public function simpan(Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            
            'id_buku'=>'required',
            'id_transaksi'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $total=DB::table('buku')->where('id', $req->id_buku)->first();
        $subtotal = ($total->harga_buku * $req->qty);
        $simpan=Detail::create([
            'id_buku'=>$req->id_buku,
            'id_transaksi'=>$req->id_transaksi,
            'subtotal'=>$subtotal,
            'qty'=>$req->qty
        ]);
        if($simpan){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }

    public function ubah($id, Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            
            'id_buku'=>'required',
            'id_transaksi'=>'required',
            'subtotal'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Detail::where('id', $id)->update([
            'id_buku'=>$req->id_buku,
            'id_transaksi'=>$req->id_transaksi,
            'subtotal'=>$req->subtotal,
            'qty'=>$req->qty
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }
    public function destroy($id){
        if(Auth::user()->level=="petugas"){
        $hapus=Detail::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil_detail(){
        if(Auth::user()->level=="petugas"){
        $detail=DB::table('detail')
        ->join('transaksi','transaksi.id','=','detail.id_transaksi')
        ->join('buku','buku.id','=','detail.id_buku')
        ->select('buku.judul', 'buku.harga_buku', 'detail.qty', 'detail.subtotal')
        ->get();
        $count=$detail->count();
        return response()->json(compact('detail', 'count'));
}
    }
}
