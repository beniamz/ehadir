<?php

namespace App\Http\Controllers;

use App\Models\Madrasah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class MadrasahController extends Controller
{
    public function index(Request $request)
    {
        // $nama_madrasah = $request->nama_madrasah;
        // $query = Madrasah::query();
        // $query->select('*');
        // if(!empty($nama_dept)) {
        //     $query->where('nama_madrasah' , 'LIKE' , '%' .$nama_madrasah. '%');
        // }
        // $madrasah = $query->get();

        $madrasah = DB::table('madrasah')->orderBy('kode_madrasah')->get();
        return view('madrasah.index', compact('madrasah'));
    }
    

    public function store (Request $request)
    {
        $kode_madrasah = $request->kode_madrasah;
        $nama_madrasah = $request->nama_madrasah;
        $lokasi_madrasah = $request->lokasi_madrasah;
        $radius_madrasah = $request->radius_madrasah;

        try {
            $data = [
                'kode_madrasah' => $kode_madrasah,
                'nama_madrasah' => $nama_madrasah,
                'lokasi_madrasah' => $lokasi_madrasah,
                'radius_madrasah' => $radius_madrasah
            ];

            DB::table('madrasah')->insert($data);
            return Redirect::back()->with(['success' => 'Alhamdulillah.., Data Madrasah berhasil disimpan !']);

        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Oopps..., Data Madrasah Gagal Disimpan !']);
        }
    }

    public function edit(Request $request) 
    {
        $kode_madrasah = $request->kode_madrasah;
        $madrasah = DB::table('madrasah')->where('kode_madrasah', $kode_madrasah)->first();
        return view('madrasah.edit', compact('madrasah'));
    }

    public function update (Request $request)
    {
        $kode_madrasah = $request->kode_madrasah;
        $nama_madrasah = $request->nama_madrasah;
        $lokasi_madrasah = $request->lokasi_madrasah;
        $radius_madrasah = $request->radius_madrasah;

        try {
            $data = [
                'nama_madrasah' => $nama_madrasah,
                'lokasi_madrasah' => $lokasi_madrasah,
                'radius_madrasah' => $radius_madrasah
            ];

            DB::table('madrasah')
            ->where('kode_madrasah', $kode_madrasah)
            ->update($data);
            return Redirect::back()->with(['success' => 'Alhamdulillah.., Data Madrasah berhasil Diupdate !']);

        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Oopps..., Data Madrasah Gagal Diupdate !']);
        }
    }

    public function delete($kode_madrasah) 
    {
        $delete = DB::table('madrasah')->where('kode_madrasah', $kode_madrasah)->delete();
        if($delete) {
            return Redirect::back()->with(['success' => 'Alhamdulillah, Data Berhasil Dihapus!']);
        }else{
            return Redirect::back()->with(['warning' => 'Data gagal Dihapus!']);
            
        }
    }

}
