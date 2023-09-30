<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Stmt\TryCatch;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        $cuti = DB::table('master_cuti')->orderBy('kode_cuti', 'asc')->get();
        return view('cuti.index', compact('cuti'));
    }

    public function store(Request $request)
    {
        $kode_cuti = $request->kode_cuti;
        $nama_cuti = $request->nama_cuti;
        $jml_hari = $request->jml_hari;

        $cekcuti = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->count();
        if($cekcuti > 0) {
            return Redirect::back()->with(['warning' => 'Data dengan Kode Cuti tersebut sudah ada!' ]);
        }

        try {
            DB::table('master_cuti')->insert([
                'kode_cuti' => $kode_cuti,       
                'nama_cuti' => $nama_cuti,
                'jml_hari'  => $jml_hari
            ]);
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan' ]);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan' . $e->getMessage()]);
            
        }
    }

    public function edit(Request $request)
    {
        $kode_cuti = $request->kode_cuti;
        $cuti = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->first();
        return view('cuti.edit', compact('cuti'));
    }

    public function update($kode_cuti, Request $request)
    {
        $nama_cuti     = $request->nama_cuti; 
        $jml_hari      = $request->jml_hari; 
        
        try {
            DB::table('master_cuti')->where('kode_cuti',$kode_cuti)
            ->update([
                'nama_cuti' => $nama_cuti,
                'jml_hari'  => $jml_hari   
            ]);
                return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update' .$e->getMessage()]);
            //throw $th;
        }
    }

    public function delete($kode_cuti) 
    {
        try {
            DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->delete();

            return Redirect::back()->with(['success' => 'Alhamdulillah, Data Berhasil Dihapus!']);
        } catch (\Throwable $e) {
            return Redirect::back()->with(['warning' => 'Data gagal Dihapus!' .$e->getMessage()]);
        }       
    }
}
