<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
     // merubah nama hari ke indonesia di jam digital
     public function gethari()
     {
         $hari = date("D");

         switch ($hari) {
            case 'Sun' :
                $hari_ini = "Minggu"; 
                break;
            
            case 'Mon' :
                $hari_ini = "Senin"; 
                break;
            
            case 'Tue' :
                $hari_ini = "Selasa"; 
                break;
            
            case 'Wed' :
                $hari_ini = "Rabu"; 
                break;
            
            case 'Thu' :
                $hari_ini = "Kamis"; 
                break;
            
            case 'Fri' :
                $hari_ini = "Jumát"; 
                break;
            
            case 'Sat' :
                $hari_ini = "Sabtu"; 
                break;
            
            default:
                $hari_ini = "Tidak diketahui";
                break;        
         }
         return $hari_ini;
     }


    public function create()
    {
       //mengecek absen hari / tidak boleh dua kali
        $hariini = date("Y-m-d");
        $namahari = $this->gethari();
        // dd($namahari);
        $nik = Auth::guard('pendidik')->user()->nik;
        $kode_dept = Auth::guard('pendidik')->user()->kode_dept;
        $cek = DB::table('presensi')
                ->where('tgl_presensi', $hariini)
                ->where('nik', $nik)->count();
        
        //titik lokasi kantor        
        $kode_madrasah = Auth::guard('pendidik')->user()->kode_madrasah;
        $tilok = DB::table('madrasah')->where('kode_madrasah', $kode_madrasah)->first(); 
        
        //mendapatkan data jam kerja perorangan
        $jamkerja = Db::table('konfigurasi_jamkerja')->where('nik', $nik)
        ->join('jam_kerja', 'konfigurasi_jamkerja.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('hari', $namahari)->first();
        //mendapatkan data jam kerja dari departemen
            if($jamkerja == null ) {
                $jamkerja = DB::table('konfigurasi_jk_dept_detail')
                ->join('konfigurasi_jk_dept', 'konfigurasi_jk_detp_detail.kode_jk_dept', '=', 'konfigurasi_jk_dept.kode_jk_dept')
                ->join('jam_kerja', 'konfigurasi_jk_dept_detail.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
                ->where('kode_dept',  $kode_dept)
                ->where('kode_madrasah', $kode_madrasah)
                ->where('hari', $namahari)->first();  
            }             
        // dd($jamkerja);
        if($jamkerja == null ) {
            return view('presensi.notifjamker');
        } else {
            return view('presensi.create', compact('cek','tilok', 'jamkerja'));
        }
        // return view('presensi.create', compact('cek','tilok', 'jamkerja'));
    }

    public function store(Request $request)
    {

        $nik = Auth::guard('pendidik')->user()->nik;
        $kode_madrasah = Auth::guard('pendidik')->user()->kode_madrasah;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");

        //lokasi Kantor
        $tilok = DB::table('madrasah')->where('kode_madrasah', $kode_madrasah)->first();
        $lok = explode(",",$tilok->lokasi_madrasah);
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        
        //lokasi user
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        
        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius =  round($jarak["meters"]);

        // tidak bisa absen klo bukan jam kerjanya
        $namahari = $this->gethari();
        $jamkerja = Db::table('konfigurasi_jamkerja')->where('nik', $nik)
        ->join('jam_kerja', 'konfigurasi_jamkerja.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('hari', $namahari)->first();
        // dd($jamkerja);

        //cek nik
        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

        if($cek > 0){
            $ket = "out";
        } else {
            $ket = "in";
        }

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;        

        //cek jarak sebelum absen
        if($radius > $tilok->radius_madrasah) {
            echo "error|Maaf Anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari Kantor!|radius";
        } else {            
             if ($cek > 0) {
                // tidak bisa absen pulang jika belum waktunya
                if($jam < $jamkerja->jam_pulang) {
                    echo "error|Maaf Belum Waktunya Pulang|belumwaktupulang";
                } else {
                    $data_pulang = [
                        'jam_out'        => $jam,
                        'foto_out'       => $fileName,
                        'lokasi_out'     => $lokasi
                    ];
                    $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                    if($update){
                        echo  "success|Terima Kasih, Hati-hati Di Jalan!|out";
                        Storage::put($file, $image_base64);        
                    } else {
                        echo "error|Maaf Gagal Absen, Silahkan Hubungi Tim IT|out";
                    }
                }
            } else {
                // tidak bisa absen jika bukan jam kerjanya
                if ($jam < $jamkerja->awal_jam_masuk) {
                    echo "error|Maaf.., Belum waktunya melakukan Absensi|belumwaktuabsen";
                } else if ($jam > $jamkerja->akhir_jam_masuk) {
                    echo "error|Maaf tidak bisa Absen, karena melewati batas akhir jam absensi hari ini|batasakhirabsen";
                    } else {
                        $data = [
                            'nik'               => $nik,
                            'tgl_presensi'      => $tgl_presensi,
                            'jam_in'            => $jam,
                            'foto_in'           => $fileName,
                            'lokasi_in'         => $lokasi,
                            'kode_jam_kerja'    => $jamkerja->kode_jam_kerja
                        ];
                
                        $simpan = DB::table('presensi')->insert($data);
                        if($simpan){
                            echo "success|Terima Kasih, Bismillah, Selamat Bekerja!|in";
                            Storage::put($file, $image_base64);        
                        } else {
                            echo "error|Maaf Gagal Absen, Silahkan Hubungi Tim IT|in";
                        }
                    }
            } 
        }       
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nik = Auth::guard('pendidik')->user()->nik;
        $pendidik = DB::table('pendidik')->where('nik',$nik)->first();
        
        return view('presensi.editprofile', compact('pendidik'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('pendidik')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $nuptk = $request->nuptk;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);        
        $pendidik = DB::table('pendidik')->where('nik', $nik)->first();
        $request->validate([
            'foto' => 'image|mimes:jpg|max:5000|required'
        ]);

        if($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $pendidik->foto;
        }
        if(empty($request->password)) {
            $data = [
                'nama_lengkap'  => $nama_lengkap,
                'nuptk'         => $nuptk,
                'jabatan'       => $jabatan,
                'no_hp'         => $no_hp,    
                'foto'          => $foto                        
            ];
            
        } else {
            $data = [
                'nama_lengkap'  => $nama_lengkap,
                'nuptk'         => $nuptk,
                'jabatan'       => $jabatan,
                'no_hp'         => $no_hp,
                'password'      => $password,
                'foto'          => $foto
            ];
        }
     
        $update = DB::table('pendidik')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto')) {
               $folderPath = "public/uploads/pendidik/";
               $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Alhamdulillah, Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update']);
        }
    }

    public function histori()
    {
        $namabulan = ["","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember"];

        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('pendidik')->user()->nik;

        $histori = DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->where('nik', $nik)
        ->orderBy('tgl_presensi')
        ->get();    
        
        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('pendidik')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik', $nik)->orderByDesc('tgl_izin_dari')->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function buatizin()
    {        
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('pendidik')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik'       => $nik,
            'tgl_izin'  => $tgl_izin,
            'status'    => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if($simpan){
            return redirect('/presensi/izin')->with(['success'=>'Alhamdulillah, Data Ajuan Berhasil Disimpan']);
        }else {
            return redirect('/presensi/izin')->with(['error'=>'Ooops, Data Ajuan Gagal Disimpan']);
        }
    }

    //monitoring presensi

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*', 'nama_lengkap', 'nama_dept', 'nuptk', 'jam_masuk', 'nama_jam_kerja', 'jam_masuk', 'jam_pulang')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=' , 'jam_kerja.kode_jam_kerja')
        ->join('pendidik', 'presensi.nik', '=', 'pendidik.nik')        
        ->join('departemen', 'pendidik.kode_dept', '=', 'departemen.kode_dept')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi', compact('presensi'));

    }

    public function tampilkanpeta(Request $request) 
    {
        $id = $request->id;
        $presensi = DB::table('presensi')
        ->where('id', $id)
        ->join('pendidik', 'presensi.nik', '=' , 'pendidik.nik' )
        ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan() 
    {
        $namabulan = ["","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember"];
        $pendidik = DB::table('pendidik')->orderBy('nama_lengkap')->get();

        return view('presensi.laporan', compact('namabulan', 'pendidik'));
    }

    public function cetaklaporan(Request $request)
    {
        $nik    = $request->nik;
        $bulan  = $request->bulan;
        $tahun  = $request->tahun;
        $namabulan = ["","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember"];
        $madrasah = DB::table('madrasah')->first();

        $pendidik = DB::table('pendidik')->where('nik', $nik)
            ->join('departemen', 'pendidik.kode_dept', '=', 'departemen.kode_dept')
            ->first();

        $presensi = DB::table('presensi')
            ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=' , 'jam_kerja.kode_jam_kerja')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
            ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
            ->orderBy('tgl_presensi')
            ->get();
        
        //Export Excel
        if (isset($_POST['exportexcel'])) {
            $time = date("d-M-Y  H:i:s");
            //fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            //mengidentifikasi nama file ekspor "hasil-export.xls"
            header("Content-Disposition: attachment; filename=Laporan Kehadiran $time.xls");
            return view('presensi.cetaklaporanexcel', compact('bulan', 'tahun', 'namabulan', 'pendidik', 'presensi'));
        }

        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'pendidik', 'presensi', 'madrasah'));

    }

    public function rekap() 
    {
        $namabulan = ["","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember"];     

        return view('presensi.rekap', compact('namabulan'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan  = $request->bulan;
        $namabulan = ["","Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember"];
        $tahun  = $request->tahun;
        $madrasah = DB::table('madrasah')->first();
        $rekap  = DB::table('presensi')
            ->selectRaw('presensi.nik,nama_lengkap,jam_masuk,jam_pulang,
            MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) AS tgl_31')
            ->join('pendidik','presensi.nik','=','pendidik.nik')
            ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=' , 'jam_kerja.kode_jam_kerja')
            ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
            ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
            ->groupByRaw('presensi.nik,nama_lengkap,jam_masuk,jam_pulang')
            ->get();
            // dd($rekap);

            //Export Excel
            if (isset($_POST['exportexcel'])) {
                $time = date("d-M-Y  H:i:s");
                //fungsi header dengan mengirimkan raw data excel
                header("Content-type: application/vnd-ms-excel");
                //mengidentifikasi nama file ekspor "hasil-export.xls"
                header("Content-Disposition: attachment; filename=Rekapitulasi Kehadiran Pendidik $time.xls");
            }

        return view('presensi.cetakrekap', compact('bulan','tahun','rekap','namabulan', 'madrasah'));
    }

    public function izinsakit(Request $request)
    {
        // QUERY DENGAN FUNGSI PENCARIAN MENGUNAKAN MODEL AJUAN IZIN
        $query = Pengajuanizin::query();
        $query->select('id', 'tgl_izin_dari', 'pengajuan_izin.nik', 'nama_lengkap', 'status_approved', 'jabatan','keterangan');
        $query->join('pendidik', 'pengajuan_izin.nik', '=' , 'pendidik.nik');
        // cek input pencarian
        if(!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_izin_dari', [$request->dari, $request->sampai]);
        }

        if(!empty($request->nik)) {
            $query->where('pengajuan_izin.nik', $request->nik);
        }

        if(!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'LIKE' , '%' . $request->nama_lengkap . '%');
        }

        if($request->status_approved == '0' || $request->status_approved == '1' || $request->status_approved == '2') {
            $query->where('status_approved', $request->status_approved);
        }

        $query->orderBy('tgl_izin_dari', 'desc');
        $izinsakit = $query->paginate(10);
        $izinsakit->appends($request->all());

        // QUERY TANPA FUNGSI PENCARIAN
        // $izinsakit = DB::table('pengajuan_izin')
        //     ->join('pendidik', 'pengajuan_izin.nik', '=' , 'pendidik.nik')
        //     ->orderBy('tgl_izin', 'desc')
        //     ->get();

        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request) 
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;

        $update = DB::table('pengajuan_izin')->where('id',$id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Ajuan Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Ajuan Gagal Di Update']);
        }
    }

    public function batalkanizinsakit($id)
    {
        $update = DB::table('pengajuan_izin')->where('id',$id)->update([
            'status_approved' => 0
        ]);
        if($update) {
            return Redirect::back()->with(['success' => 'Data Ajuan Izin Sakit Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Ajuan Izin Sakit gagal Di Update']);
        }
    }

    public function cekpengajuanizin(Request $request) 
    {
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('pendidik')->user()->nik;

        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();

        return $cek;
    }


}
