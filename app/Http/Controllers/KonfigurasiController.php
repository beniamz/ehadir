<?php

namespace App\Http\Controllers;

use App\Models\Setjamkerja;
use App\Models\Setjamkerjadept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
        $jam_kerja = DB::table('jam_kerja')->orderBy('kode_jam_kerja')->get();
        return view('konfigurasi.jamkerja', compact('jam_kerja'));
    }

    public function storejamkerja(Request $request) {

        $kode_jam_kerja     = $request->kode_jam_kerja;
        $nama_jam_kerja     = $request->nama_jam_kerja;
        $awal_jam_masuk     = $request->awal_jam_masuk;
        $jam_masuk          = $request->jam_masuk;
        $akhir_jam_masuk    = $request->akhir_jam_masuk;
        $jam_pulang         = $request->jam_pulang;
        
        $data = [
            'kode_jam_kerja'    => $kode_jam_kerja,
            'nama_jam_kerja'    => $nama_jam_kerja,
            'awal_jam_masuk'    => $awal_jam_masuk,
            'jam_masuk'         => $jam_masuk,
            'akhir_jam_masuk'   => $akhir_jam_masuk,
            'jam_pulang'        => $jam_pulang,
        ];

        try {
             DB::table('jam_kerja')->insert($data);
                return Redirect::back()->with(['success' => 'Alhamdulillah, Data Jam Kerja Berhasil Disimpan.']); 
            } catch (\Exception $e) {
                return Redirect::back()->with(['warning' => 'Oppps..,Data Jam Kerja Gagal Disimpan.']); 
        }

    }

    public function editjamkerja(Request $request) {

        $kode_jam_kerja = $request->kode_jam_kerja;
        $jam_kerja = DB::table('jam_kerja')->where('kode_jam_kerja', $kode_jam_kerja)->first();
        return view('konfigurasi.editjamkerja', compact('jam_kerja'));
    }

    public function updatejamkerja(Request $request) {

        $kode_jam_kerja     = $request->kode_jam_kerja;
        $nama_jam_kerja     = $request->nama_jam_kerja;
        $awal_jam_masuk     = $request->awal_jam_masuk;
        $jam_masuk          = $request->jam_masuk;
        $akhir_jam_masuk    = $request->akhir_jam_masuk;
        $jam_pulang         = $request->jam_pulang;
        
        $data = [
           
            'nama_jam_kerja'    => $nama_jam_kerja,
            'awal_jam_masuk'    => $awal_jam_masuk,
            'jam_masuk'         => $jam_masuk,
            'akhir_jam_masuk'   => $akhir_jam_masuk,
            'jam_pulang'        => $jam_pulang,
        ];

        try {
             DB::table('jam_kerja')->where('kode_jam_kerja', $kode_jam_kerja)->update($data);
                return Redirect::back()->with(['success' => 'Alhamdulillah, Data Jam Kerja Berhasil Diupdate.']); 
            } catch (\Exception $e) {
                return Redirect::back()->with(['warning' => 'Oppps..,Data Jam Kerja Gagal Diupdate.']); 
        }

    }

    public function deletejamkerja($kode_jam_kerja) 
    {
        $delete = DB::table('jam_kerja')->where('kode_jam_kerja', $kode_jam_kerja)->delete();
        if($delete) {
            return Redirect::back()->with(['success' => 'Alhamdulillah, Data Jam Kerja Berhasil Dihapus!']);
        }else{
            return Redirect::back()->with(['warning' => 'Data jam Kerja Gagal Dihapus!']);
            
        }
    }

    public function setjamkerja($nik) 
    {
        //AMBIL DATA GURU BERDASARKAN NIK
        $pendidik = DB::table('pendidik')->where('nik', $nik)->first();
        
        // AMBIL DATA JAM KERJA
        $jamkerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();

        $cekjamkerja = DB::table('konfigurasi_jamkerja')->where('nik', $nik)->count();
        if($cekjamkerja > 0) {

            $setjamkerja = DB::table('konfigurasi_jamkerja')->where('nik', $nik)->get();

            return view('konfigurasi.editsetjamkerja', compact('pendidik', 'jamkerja', 'setjamkerja'));            
        } else {
            return view('konfigurasi.setjamkerja', compact('pendidik', 'jamkerja'));
        }

    }

    public function storesetjamkerja(Request $request) 
    {
        $nik = $request->nik;
        $hari = $request->hari;
        $kode_jam_kerja = $request->kode_jam_kerja;

        for($i=0; $i < count($hari); $i++) {
            $data[] = [
                'nik' => $nik,
                'hari' => $hari[$i],
                'kode_jam_kerja' => $kode_jam_kerja[$i],
            ];
        }

        try {
            Setjamkerja::insert($data);
            return Redirect('/pendidik')->with(['success' => 'Alhamdulillah, Jam Kerja Berhasil Di Setting']);
        } catch (\Exception $e) {
            return Redirect('/pendidik')->with(['warning' => 'Ooops, Jam Kerja Gagal Di Setting']);
            // dd($e);
        }       
    }

    public function updatesetjamkerja(Request $request) 
    {
        $nik = $request->nik;
        $hari = $request->hari;
        $kode_jam_kerja = $request->kode_jam_kerja;

        for($i=0; $i < count($hari); $i++) {
            $data[] = [
                'nik' => $nik,
                'hari' => $hari[$i],
                'kode_jam_kerja' => $kode_jam_kerja[$i],
            ];
        }
        
        DB::beginTransaction();  // agar tidak error query atau data karena 2 fungsi

        try {
            DB::table('konfigurasi_jamkerja')->where('nik', $nik)->delete();

            Setjamkerja::insert($data);

            DB::commit();  // pasangan begin transaction

            return Redirect('/pendidik')->with(['success' => 'Alhamdulillah, Jam Kerja Berhasil Di Setting']);

        } catch (\Exception $e) {
            DB::rollBack();  // pasangan begin transaction

            return Redirect('/pendidik')->with(['warning' => 'Ooops, Jam Kerja Gagal Di Setting']);
            // dd($e);
        }       
    }

    public function jamkerjadept() 
    {
        $jamkerjadept = DB::table('konfigurasi_jk_dept')
        ->join('madrasah', 'konfigurasi_jk_dept.kode_madrasah', '=', 'madrasah.kode_madrasah')
        ->join('departemen', 'konfigurasi_jk_dept.kode_dept', '=', 'departemen.kode_dept')
        ->get();
        
        return view('konfigurasi.jamkerjadept', compact('jamkerjadept'));
    }

    public function createjamkerjadept()
    {
        // // AMBIL DATA JAM KERJA
        $jamkerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
        $madrasah = DB::table('madrasah')->get();
        $departemen = DB::table('departemen')->get();

        return view('konfigurasi.createjamkerjadept',compact('jamkerja', 'madrasah', 'departemen'));
    }

    public function storejamkerjadept(Request $request)
    {
        $kode_madrasah = $request->kode_madrasah;
        $kode_dept = $request->kode_dept;
        $hari = $request->hari;
        $kode_jam_kerja = $request->kode_jam_kerja;
        $kode_jk_dept = "J" . $kode_madrasah . $kode_dept;

        DB::beginTransaction();  // fungsi untuk menjalankan 2 query secara bersamaan

        try {
            //menyimpan data ke table Konfigurasi JK Dept
            DB::table('konfigurasi_jk_dept')->insert([
                'kode_jk_dept'  => $kode_jk_dept,
                'kode_madrasah' => $kode_madrasah,
                'kode_dept'     => $kode_dept

            ]);

            //menampung data settingsetiap hari jam kerja
            for($i=0; $i < count($hari); $i++) {
                $data[] = [                    
                    'kode_jk_dept'      => $kode_jk_dept,
                    'hari'              => $hari[$i],
                    'kode_jam_kerja'    => $kode_jam_kerja[$i],
                ];
            }
            Setjamkerjadept::insert($data);
            DB::commit();  
            return redirect('/konfigurasi/jamkerjadept')->with(['success' => 'Alhamdulillah, Data Berhasil disimpan']);

        } catch (\Exception $e) {
            DB::rollBack();    //jika error maka dikembalikan dan No save
            return redirect('/konfigurasi/jamkerjadept')->with(['warning' => 'Ooopps, Data Gagal disimpan']);
        } 
    }

    public Function editjamkerjadept($kode_jk_dept)
    {
        $jamkerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
        $madrasah = DB::table('madrasah')->get();
        $departemen = DB::table('departemen')->get();
        $jamkerjadept = DB::table('konfigurasi_jk_dept')->where('kode_jk_dept', $kode_jk_dept)->first();
        $jamkerjadeptdetail = DB::table('konfigurasi_jk_dept_detail')->where('kode_jk_dept', $kode_jk_dept)->get();

        return view('konfigurasi.editjamkerjadept', compact('jamkerja', 'madrasah', 'departemen', 'jamkerjadept', 'jamkerjadeptdetail'));
    }

    public function updatejamkerjadept($kode_jk_dept, Request $request)
    {
        
        $hari = $request->hari;
        $kode_jam_kerja = $request->kode_jam_kerja;
        
        DB::beginTransaction();  // fungsi untuk menjalankan 2 query secara bersamaan

        try {
            // query hapus data jam kerja sebelumya terlebi dahulu
            DB::table('konfigurasi_jk_dept_detail')->where('kode_jk_dept', $kode_jk_dept)->delete();
            
            //query menampung data settingsetiap hari jam kerja
            for($i=0; $i < count($hari); $i++) {
                $data[] = [     
                    'kode_jk_dept'      => $kode_jk_dept,               
                    'hari'              => $hari[$i],
                    'kode_jam_kerja'    => $kode_jam_kerja[$i],
                ];
            }
            Setjamkerjadept::insert($data);
            DB::commit();  
            return redirect('/konfigurasi/jamkerjadept')->with(['success' => 'Alhamdulillah, Data Berhasil disimpan']);

        } catch (\Exception $e) {
            DB::rollBack();    //jika error maka dikembalikan dan No save
            return redirect('/konfigurasi/jamkerjadept')->with(['warning' => 'Ooopps, Data Gagal disimpan']);
        } 
    }

    public Function showjamkerjadept($kode_jk_dept)
    {
        $jamkerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
        $madrasah = DB::table('madrasah')->get();
        $departemen = DB::table('departemen')->get();
        $jamkerjadept = DB::table('konfigurasi_jk_dept')->where('kode_jk_dept', $kode_jk_dept)->first();
        $jamkerjadeptdetail = DB::table('konfigurasi_jk_dept_detail')
        ->join('jam_kerja', 'konfigurasi_jk_dept_detail.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('kode_jk_dept', $kode_jk_dept)->get();

        return view('konfigurasi.showjamkerjadept', compact('jamkerja', 'madrasah', 'departemen', 'jamkerjadept', 'jamkerjadeptdetail'));
    }


    public function deletejamkerjadept($kode_jk_dept)
    {
        try {
            DB::table('konfigurasi_jk_dept')->where('kode_jk_dep', $kode_jk_dept)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus' ]);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Hapus' ]);            
        }
    }


}
