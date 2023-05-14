<?php

namespace App\Http\Controllers;

use App\Models\WargaModel;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function store(){
        $fields = [
            'nama_lengkap',
            'gender',
            'tgl_lahir',
            'alamat',
            'lokasi'
        ];
        
        $data = new WargaModel();
        foreach($fields as $f ){
            $data->$f = \request($f);
        }
        $data->pengguna_id = request()->user()->id;
        
        return response()->json([
            'data' => $data
        ], $data->saveOrFail() ? 200: 406 );
    }

    public function update (WargaModel $w) {
        $w->nama_lengkap = request('nama_lengkap');
        $w->gender = request('gender');
        $w->tgl_lahir = request('tgl_lahir');
        $w->alamat = request('alamat');
        $w->lokasi = request('lokasi');
        $r = $w->save();

        return response()->json([
            'data' => $w
        ], $r == true ? 200: 406);
    }

    public function delete(WargaModel $w){
        return response()->json([
            'data'  => $w->delete()
        ]);
    }
    
    public function show(WargaModel $w){
        return response()->json([
            'data'  => $w
        ]);
    }
}
