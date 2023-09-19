<?php

namespace App\Http\Controllers;

use App\Models\Pendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class PendidikController extends Controller
{
    public function index(Request $request)
    {
        

        $query = Pendidik::query();
        $query->select('pendidik.*','nama_dept');
        $query->join('departemen', 'pendidik.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBy('nama_lengkap');

        if(!empty($request->nama_pendidik)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_pendidik .'%');
        }

        if(!empty($request->kode_dept)) {
            $query->where('pendidik.kode_dept', $request->kode_dept);
        }

        $pendidik = $query->paginate(10)->fragment('pddk');

        $departemen = DB::table('departemen')->get();
        return view('pendidik.index', compact('pendidik', 'departemen'));
    }

    public function store(Request $request) 
    {

        $nik            = $request->nik;
        $nuptk          = $request->nuptk;
        $nama_lengkap   = $request->nama_lengkap;
        $jabatan        = $request->jabatan;
        $no_hp          = $request->no_hp;
        $kode_dept      = $request->kode_dept;
        $foto           = $request->foto;
        $password       = Hash::make("123456");
        //cek foto
        
        if($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        //proses simpan data
        try {
            $data = [
                'nik'           => $nik,
                'nuptk'         => $nuptk,
                'nama_lengkap'  => $nama_lengkap,
                'jabatan'       => $jabatan,
                'no_hp'         => $no_hp,
                'foto'          => $foto,
                'kode_dept'     => $kode_dept,
                'password'      => $password
            ];

            $simpan = DB::table('pendidik')->insert($data);
            if($simpan) {
                if($request->hasFile('foto')) {
                    $folderPath = "public/uploads/pendidik/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                    return Redirect::back()->with(['success' => 'Alhamdulillah, Data Berhasil Disimpan']);
                }
                
            } catch (\Exception $e) {
                // dd($e);
                if($e->getCode() == 23000) {
                    $message = "Data dengan NIK" . $nik . "Sudah Ada";
                }
                return Redirect::back()->with(['warning' => 'Ooops, Data Gagal Disimpan' .$message]);
        }
    }

    public function edit(Request $request) 
    {
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        //query tampilkan data cuma 1 data pake first
        $pendidik = DB::table('pendidik')->where('nik', $nik)->first();
        return view('pendidik.edit', compact('departemen', 'pendidik'));
    }

    public function update($nik, Request $request)
    {
        $nik            = $request->nik;
        $nuptk          = $request->nuptk;
        $nama_lengkap   = $request->nama_lengkap;
        $jabatan        = $request->jabatan;
        $no_hp          = $request->no_hp;
        $kode_dept      = $request->kode_dept;
        // $foto           = $request->foto;
        $old_foto       = $request->old_foto;
        $password       = Hash::make("123456");
        //cek foto
        
        if($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        //proses simpan data
        try {
            $data = [              
                'nuptk'         => $nuptk,
                'nama_lengkap'  => $nama_lengkap,
                'jabatan'       => $jabatan,
                'no_hp'         => $no_hp,
                'foto'          => $foto,
                'kode_dept'     => $kode_dept,
                'password'      => $password
            ];

            $update = DB::table('pendidik')->where('nik', $nik)->update($data);
            if($update) {
                if($request->hasFile('foto')) {
                    $folderPath = "public/uploads/pendidik/";
                    $folderPathOld = "public/uploads/pendidik/" .$old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                    return Redirect::back()->with(['success' => 'Alhamdulillah, Data Berhasil Diupdate']);
                }
                
            } catch (\Exception $e) {
                // dd($e);
                if($e->getCode() == 23000) {
                    $message = "Data dengan NIK" . $nik . "Sudah Ada";
                }
                return Redirect::back()->with(['warning' => 'Ooops, Data Gagal Diupdate' .$message]);
        }
    }

    public function delete($nik) 
    {
        $delete = DB::table('pendidik')->where('nik', $nik)->delete();
        if($delete) {
            return Redirect::back()->with(['success' => 'Alhamdu;illah, Data Berhasil Dihapus!']);
        }else{
            return Redirect::back()->with(['warning' => 'Data gagal Dihapus!']);
            
        }
    }


}
