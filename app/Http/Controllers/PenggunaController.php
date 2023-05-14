<?php

namespace App\Http\Controllers;

use App\Models\PenggunaModel;
use Illuminate\Support\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function login(){
        $email = request()->header('emali');
        $sandi = request()->header('sandi');

        $hasil = PenggunaModel::query()
            ->where('email', $email)->first();
        
        if($hasil == null){
            return response()->json([
                'pesan' => "Email $email pengguna tidak terdaftar"
            ], 404);
        }elseif (Hash::check($sandi, $hasil->sandi)) {
            $hasil->token = Str::random(16);
            $hasil->save();

            return response()->json([
                'data'  => $hasil
            ]);
        }else {
            return response()->json([
                'pesan'  => 'Email dan Kata Sandi tidak cocok'
            ]);
        }
    }

    public function logout(){
        $id = request()->user()->id;
        $p = PenggunaModel::query()->where('id', $id)->first;

        if ($p != null) {
            $p->token = null;
            $p->save();
            return response()->json([
                'data'  => 1
            ]);
        }else {
            return response()->json([
                'pesan' => 'Logout tidak berhasil, pengguna tidak tersedia'
            ], 404);
        }
    }

    public function update(){
        $id = request()->user()->id;
        $p = PenggunaModel::query()->where('id', $id)->first;

        if ($p == null) {
            return response()->json([
                'pesan'  => 'Pengguna tidak ditemukan'
            ], 404);
        }

        $p->nama_lengkap = request('nama_lengkap');
        $p->email = request('email');
        $r = $p->save();

        return response()->json([
            'data'  => $p
        ], $r == true ? 200 : 406);
    }

    public function simpan_foto(){
        $id = request()->user()->id;
        $p = PenggunaModel::query()->where('id', $id)->first;

        if ($p == null) {
            return response()->json([
                'pesan' => 'Pengguna tidak terdaftar'
            ], 404);
        }

        $b64foto = request('file_foto');
        
        if (strlen($b64foto) < 1023) {
            return response()->json([
                'pesan' => 'File foto kurang ukurannya'
            ], 406);
        }

        $foto = base64_decode($b64foto);
        $r = Storage::put("foto/$id.jpg", $foto);

        return response()->json([
            'data'  => $r
        ], $r == true ? 200 : 406);
    }

    public function foto(){
        $id = request()->user()->id;
        $file = "foto/$id.jpg";
        
        if(Storage::exists($file) == false){
            return response()->json([
                'pesan'=>'not found'
            ], 404);
        }
        
        $foto = Storage::get("foto/$id.jpg");

        return response()->withHeaders([
            'Content-type' => 'image/jpeg'
        ])->setContent($foto)->send();
    }
}
