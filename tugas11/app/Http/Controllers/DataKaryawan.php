<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\data_pribadi;
use App\Http\Requests;


class DataKaryawan extends Controller
{
    public function getData(){
      $data = DB::table('data_pribadi')->get();
      if(count($data)>0){
        $res['message'] = "Success";
        $res['value'] = $data;
        return response($res);
      }else{
        $res['message'] = 'Empty';
        return response($res);
      }
    }
    public function data(Request $request){
      $this->validate($request,[
        'foto' => 'required|max:2048'
      ]);
      $file = $request->file('foto');
      $nama_file = time()."_".$file->getClientOriginalName();
      $tujuan_upload = 'data_file';
      if($file->move($tujuan_upload,$nama_file)){
        $data = data_pribadi::create([
          'nama' => $request->nama,
          'jabatan' => $request->jabatan,
          'umur' => $request->umur,
          'alamat' => $request->alamat,
          'foto' => $nama_file
        ]);
        $res['message'] = "Success";
        $res['values'] = $data;
        return response($res);
      }
    }
    public function update(Request $request){
      if(!empty($request->foto)){
        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);
        $data = DB::table('data_pribadi')->where('id',$request->id)->get();
        foreach($data as $datapribadi){
          @unlink(public_path('data_file/'.$datapribadi->foto));
          $ket = DB::table('data_pribadi')->where('id',$request->id)->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'foto' => $nama_file
          ]);
          $res['message'] = 'Success';
          $res['value'] = $ket;
          return response($res);
          }
        }else{
          $data = DB::table('data_pribadi')->where('id',$request->id)->get();
          foreach($data as $datapribadi){
            $ket = DB::table('data_pribadi')->where('id',$request->id)->update([
              'nama' => $request->nama,
              'jabatan' => $request->jabatan,
              'umur' => $request->umur,
              'alamat' => $request->alamat,
            ]);
            $res['message'] = 'Success';
            $res['value'] = $ket;
            return response($res);
        }
      }
    }
    public function hapus($id){
      $data = DB::table('data_pribadi')->where('id',$id)->get();
      foreach($data as $datapribadi){
        if(file_exists(public_path('data_file/'.$datapribadi->foto))){
          @unlink(public_path('data_file/'.$datapribadi->foto));
          DB::table('data_pribadi')->where('id',$id)->delete();
          $res['message']="Success";
          return response($res);
        }else{
          $res['message']="Empty";
          return response($res);
        }
      }
    }
    public function getDetail($id){
      $data = DB::table('data_pribadi')->where('id',$id)->get();
      if(count($data)>0){
        $res['message'] = "Success";
        $res['value'] = $data;
        return response($res);
      }else{
        $res['message'] = "Empty!";
        return response($res);
      }
    }
}
