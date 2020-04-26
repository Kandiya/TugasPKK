<?php

namespace App\Http\Controllers;

use App\Reminder;
use JWTAuth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="pengguna"){
        $validator=Validator::make($req->all(),
        [
            'judul'=>'required',
            'deskripsi'=>'required',
            'deadline'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Reminder::create([
            'judul'=>$req->judul,
            'deskripsi'=>$req->deskripsi,
            'deadline'=>$req->deadline
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
            'judul'=>'required',
            'deskripsi'=>'required',
            'deadline'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Reminder::where('id', $id)->update([
            'judul'=>$req->judul,
            'deskripsi'=>$req->deskripsi,
            'deadline'=>$req->deadline
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
        $hapus=Reminder::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil(){
        if(Auth::user()->level=="pengguna"){
      $data_reminder = Reminder::get();
      $count = $data_reminder->count();
      $arr_data = array();
      foreach ($data_reminder as $dt_r){
        $arr_data[] = array(
          'id' => $dt_r->id,
          'judul'=>$dt_r->judul,
          'deskripsi'=>$dt_r->deskripsi,
          'deadline'=>$dt_r->deadline
        );
      }
      $status=1;
      return Response()->json(compact('count','count', 'arr_data'));
}
}
}
