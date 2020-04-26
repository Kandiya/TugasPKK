<?php

namespace App\Http\Controllers;

use App\Diary;
use JWTAuth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DiaryController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="pengguna"){
        $validator=Validator::make($req->all(),
        [
            'tanggal'=>'required',
            'judul'=>'required',
            'isi'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Diary::create([
            'tanggal'=>$req->tanggal,
            'judul'=>$req->judul,
            'isi'=>$req->isi
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
        if(Auth::user()->level=="pengguna"){
        $validator=Validator::make($req->all(),
        [
            'tanggal'=>'required',
            'judul'=>'required',
            'isi'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Diary::where('id', $id)->update([
            'tanggal'=>$req->tanggal,
            'judul'=>$req->judul,
            'isi'=>$req->isi
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}

    public function hapus($id){
        if(Auth::user()->level=="pengguna"){
        $hapus=Diary::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil(){
        if(Auth::user()->level=="pengguna"){
      $data_diary = Diary::get();
      $count = $data_diary->count();
      $arr_data = array();
      foreach ($data_diary as $dt_d){
        $arr_data[] = array(
          'id' => $dt_d->id,
          'tanggal'=>$dt_d->tanggal,
          'judul'=>$dt_d->judul,
          'isi'=>$dt_d->isi
        );
      }
      $status=1;
      return Response()->json(compact('count','count', 'arr_data'));
}
}
}
