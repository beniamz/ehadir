<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page { size: A4 }
    
    .title {
      width: 95%;
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      font-weight: bold;  
      border: 0.5px solid ;      
      margin-left: 1cm;
      
    }

    .tabeldatapendidik {
      margin-top: 1px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;  
      margin-left: 1cm;
      border: 1px solid ; 
      
    }

    .tabeldatapendidik td {
      padding: 3px;
    }

    .tabelpresensi {
      width: 100%;
      margin-top: 3px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      border-collapse: collapse;
      margin-left: 1cm;
    }

    .tglcetak {
      border: 1px solid ;
      width: 100%;
      margin-left: 1cm;
      margin-top: 3px;
      margin-bottom: 3px;
      font-size: 13px;  
      font-family: Arial, Helvetica, sans-serif;
    }

    .tabelpresensi tr th {
      border: 1px solid ;
      padding:3px;
      background-color: #dbdbdd;      
    }

    .tabelpresensi tr td {
      border: 1px solid ;
      padding:1px;
         
    }

    .foto {
      width: 25px;
      height: 25px;
    }

    .header {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      padding-top:5px;
      padding-bottom:5px;
      margin-left: 1cm;
      margin-top: 3px;
      border: 1px solid ;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
@php
function selisih($jam_masuk, $jam_keluar)
{
    list($h, $m, $s) = explode(":", $jam_masuk);
    $dtAwal = mktime($h, $m, $s, "1", "1", "1");
    list($h, $m, $s) = explode(":", $jam_keluar);
    $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
    $dtSelisih = $dtAkhir - $dtAwal;
    $totalmenit = $dtSelisih / 60;
    $jam = explode(".", $totalmenit / 60);
    $sisamenit = ($totalmenit / 60) - $jam[0];
    $sisamenit2 = $sisamenit * 60;
    $jml_jam = $jam[0];
    return $jml_jam . ":" . round($sisamenit2);
}
@endphp

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
<!-- 
    <table style="width: 100%">
      <tr class="mt-3">
        <td>
          <img src="{{ asset('assets/img/kop_mi.png') }}" width="100%" height="170px">
        </td>
      </tr>
    </table> -->
  
    <div class="table-responsive-sm">

      <table class="title" style="width:95% ">
        <tr >
          <th >
            <b>LAPORAN DETAIL HARIAN KEHADIRAN GURU</b>
          </th>         
        </tr>        
        <tr>
          <th><b>{{ strtoupper($madrasah->nama_madrasah) }}</b></th>
        </tr>           
      </table>

      <table class="tglcetak" style="width:95%">
        <tr>   
          <td style="background-color: #dbdbdd; text-align: center">Periode Bulan</td> 
          <td><b>{{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}</b></td> 
          <td style="background-color: #dbdbdd; text-align: center" >Tanggal Cetak</td> 
          <td><b> {{ date("d-m-Y")}} </b></td>
        </tr> 
      </table>
    
      <table class="tabeldatapendidik" style="width: 95%">
      <tr>
          <td rowspan="4" style="text-align:center">
            @php
              $path = Storage::url('uploads/pendidik/'.$pendidik->foto);
            @endphp
              <img src="{{ url($path) }}" alt="" width="60px" height="70px">
          </td>
         
        </tr>
        <tr>
          <td style="background-color: #dbdbdd;">Nama Lengkap</td>
          <td><b>{{ strtoupper($pendidik->nama_lengkap)}}</b></td>

          <td style="background-color: #dbdbdd;">Jabatan</td>          
          <td><b>{{ $pendidik->jabatan}}</b></td>
          
        </tr>  
        <tr>
          <td style="background-color: #dbdbdd;">NUPTK</td>          
          <td><b>{{ $pendidik->nuptk}}</b></td>
          
          <td style="background-color: #dbdbdd;">Status Pendidik</td>         
          <td><b>{{ $pendidik->nama_dept}}</b></td>
        </tr> 
        <tr>
          <td style="background-color: #dbdbdd;">NIK</td>          
          <td><b>{{ $pendidik->nik}}</b></td>
          
          
          <td style="background-color: #dbdbdd;">No Handphone</td>          
          <td><b>{{ $pendidik->no_hp}}</b></td>
        </tr>
      </table>
      <table class="tabelpresensi" style="width: 95%">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Absen Masuk</th>
            <th>Foto</th>
            <th>Jam Pulang</th>
            <th>Absen Pulang</th>
            <th>Foto</th>           
            <th>Keterangan</th>
            <th>Jml. Jam Kerja</th>
          </tr>
          @foreach ($presensi as $d)
          @php
              $foto_in = Storage::url('uploads/absensi/'.$d->foto_in);
              $foto_out = Storage::url('uploads/absensi/'.$d->foto_out);

              $jamterlambat = selisih($d->jam_masuk, $d->jam_in);
          @endphp
          <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td style="text-align: center">{{ date("d-m-y", strtotime($d->tgl_presensi)) }}</td>
            <td style="text-align: center">{{ $d->jam_masuk}}</td>
            <td style="text-align: center">{{ $d->jam_in != null ? $d->jam_in : 'Tidak Absen' }}</td>
            <td style="text-align: center"><img src="{{ url($foto_in) }}" alt="foto" class="foto"></td>
            <td style="text-align: center">{{ $d->jam_pulang }}</td>
            <td style="text-align: center">{{ $d->jam_out != null ? $d->jam_out : 'Tidak Absen' }}</td>
            <td style="text-align: center">
              @if($d->jam_out != null)
                <img src="{{ url($foto_out) }}" alt="foto" class="foto">
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera-question" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M15 20h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v2.5"></path>
                  <path d="M14.975 12.612a3 3 0 1 0 -1.507 3.005"></path>
                  <path d="M19 22v.01"></path>
                  <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                </svg>
              @endif
            </td>          
            <td style="text-align: center">
              @if($d->jam_in > $d->jam_masuk)
                Terlambat ( {{ $jamterlambat }} )
              @else
                Tepat Waktu
              @endif
            </td>
            <td style="text-align: center">
              @if($d->jam_out != null)
                  @php
                    $jmljamkerja = selisih($d->jam_in,$d->jam_out);
                  @endphp
                @else
                  @php
                  $jmljamkerja = 0;
                  @endphp
              @endif
                {{ $jmljamkerja }} Jam/Hari
            </td>
          </tr>
          @endforeach
      </table> 

      
      <table class=" header table table-bordered" width="95%" >
            <tr>
              <th style="text-align: center">Mengetahui</th>
              <td style="text-align: center">Kota Depok, {{ date("d-m-Y")}}</td>
            </tr>
            <tr>
              <td style="text-align: center">Kepala Madrasah,</td>
              <td style="text-align: center">Ka.Ur. Tata Usaha</td>
            </tr>
            <tr>
              <td 
                style="text-align: center; vertical-align:bottom" height="50px"><u><b>{{ strtoupper($madrasah->nama_kamad) }}</u></b>
              </td>
              <td 
                style="text-align: center; vertical-align:bottom" height="50px"><u><b>{{ strtoupper($madrasah->nama_kaur_tu) }}</u></b>
              </td>
            </tr>
            
      </table>


    </div>
  </section>

</body>

</html>