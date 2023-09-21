<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;

class KonfigurasiController extends Controller
{
    public function lokasikantor() 
    {
        $tilok = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('konfigurasi.lokasikantor', compact('tilok'));
    }

    public function updatelokasikantor(Request $request) 
    {
        $lokasi_kantor  = $request->lokasi_kantor;
        $radius         = $request->radius;

        $update = DB::table('konfigurasi_lokasi')->where('id',1)->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius'        => $radius
        ]);

        if($update) {
           return Redirect::back()->with(['success' => 'Data Titik Lokasi Berhasil Diupdate!']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Titik Lokasi Gagal Diupdate!']);
        }
    }

    public function jamkerja() 
    {
        
        return view('konfigurasi.jamkerja');
    }
}
