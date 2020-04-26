<?php

namespace App\Http\Controllers;

use App\Mapel;
use JWTAuth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="pengguna"){
        $validator=Validator::make($req->all(),
        [
            'nama_mapel'=>'required',
            'waktu'=>'required',
            'guru'=>'required',
            'hari'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Mapel::create([
            'nama_mapel'=>$req->nama_mapel,
            'waktu'=>$req->waktu,
            'guru'=>$req->guru,
            'hari'=>$req->hari
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
            'nama_mapel'=>'required',
            'waktu'=>'required',
            'guru'=>'required',
            'hari'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Mapel::where('id', $id)->update([
            'nama_mapel'=>$req->nama_mapel,
            'waktu'=>$req->waktu,
            'guru'=>$req->guru,
            'hari'=>$req->hari
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
        $hapus=Mapel::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil(){
        if(Auth::user()->level=="pengguna"){
      $data_mapel = Mapel::get();
      $count = $data_mapel->count();
      $arr_data = array();
      foreach ($data_mapel as $dt_m){
        $arr_data[] = array(
          'id' => $dt_m->id,
          'nama_mapel'=>$dt_m->nama_mapel,
          'waktu'=>$dt_m->waktu,
          'guru'=>$dt_m->guru,
          'hari'=>$dt_m->hari
        );
      }
      $status=1;
      return Response()->json(compact('count','count', 'arr_data'));
}
}
}
