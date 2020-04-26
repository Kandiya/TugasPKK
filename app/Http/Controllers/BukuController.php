<?php

namespace App\Http\Controllers;

use App\Buku;
use JWTAuth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'judul'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required',
            'harga_buku'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Buku::create([
            'judul'=>$req->judul,
            'deskripsi'=>$req->deskripsi,
            'foto'=>$req->foto,
            'harga_buku'=>$req->harga_buku
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
            'judul'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required',
            'harga_buku'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Buku::where('id', $id)->update([
            'judul'=>$req->judul,
            'deskripsi'=>$req->deskripsi,
            'foto'=>$req->foto,
            'harga_buku'=>$req->harga_buku
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
        $hapus=Buku::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil(){
      $data_buku = Buku::get();
      $count = $data_buku->count();
      $arr_data = array();
      foreach ($data_buku as $dt_b){
        $arr_data[] = array(
          'id' => $dt_b->id,
          'judul'=>$dt_b->judul,
          'deskripsi'=>$dt_b->deskripsi,
          'foto'=>$dt_b->foto,
          'harga_buku'=>$dt_b->harga_buku
        );
      
      $status=1;
      return Response()->json(compact('count','count', 'arr_data'));
}
}
}
