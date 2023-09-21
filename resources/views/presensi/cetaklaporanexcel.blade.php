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
      width: 100%;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      font-weight: bold;  
      
    }

    .tabeldatapendidik {
      margin-top: 10px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;  
      margin-left: 1cm;
    }

    .tabeldatapendidik td {
      padding: 3px;
      
    }

    .tabelpresensi {
      width: 100%;
      margin-top: 10px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      border-collapse: collapse;
      margin-left: 1cm;
    }

    .tabelpresensi tr th {
      border: 1px solid ;
      padding:3px;
      background-color: #dbdbdd;      
    }

    .tabelpresensi tr td {
      border: 1px solid ;
      padding:3px;
         
    }

    .foto {
      width: 25px;
      height: 25px;
    }

    .header {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      padding-top: 20px;
      margin-left: 1cm;
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
  <section class="sheet padding-5mm">

    <table style="width: 100%">
      <tr>
        <td>
          <!-- <img src="{{ asset('assets/img/kop_mi.png') }}" width="100%" height="170px"> -->
        </td>
      </tr>
    </table>
  
    <div class="table-responsive-sm">

      <table style="width: 100%">
        <tr>
          <td style="text-align:center">
            <span class="title" >
            LAPORAN PRESENSI<br>
            PERIODE BULAN : {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}
            </span>
          </td>
        </tr>        
      </table>

      <table class="tabeldatapendidik" style="width: 90%">
      <tr>
          <td rowspan="4" style="text-align:center">
            @php
              $path = Storage::url('uploads/pendidik/'.$pendidik->foto);
            @endphp
              <img src="{{ url($path) }}" alt="" width="60px" height="70px">
          </td>
         
        </tr>
        <tr>
          <td>NIK</td>
          <td>:</td>
          <td>{{ $pendidik->nik}}</td>
          
          <td>Jabatan</td>
          <td>:</td>
          <td>{{ $pendidik->jabatan}}</td>
        </tr>  
        <tr>
          <td>NUPTK</td>
          <td>:</td>
          <td>{{ $pendidik->nuptk}}</td>

          <td>Status Pendidik</td>
          <td>:</td>
          <td>{{ $pendidik->nama_dept}}</td>
        </tr> 
        <tr>
          <td>Nama Lengkap</td>
          <td>:</td>
          <td>{{ $pendidik->nama_lengkap}}</td>

          <td>No Handphone</td>
          <td>:</td>
          <td>{{ $pendidik->no_hp}}</td>
        </tr>
      </table>
      <table class="tabelpresensi" style="width: 90%">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>           
            <th>Jam Pulang</th>                   
            <th>Keterangan</th>
            <th>Jml. Jam Kerja</th>
          </tr>
          @foreach ($presensi as $d)
          @php
              $jamterlambat = selisih('07:00:00', $d->jam_in);
          @endphp
          <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td style="text-align: center">{{ date("d-m-y", strtotime($d->tgl_presensi)) }}</td>
            <td style="text-align: center">{{ $d->jam_in != null ? $d->jam_in : 'Tidak Absen' }}</td>           
            <td style="text-align: center">{{ $d->jam_out != null ? $d->jam_out : 'Tidak Absen' }}</td>                
            <td style="text-align: center">
              @if($d->jam_in > "07:15:00")
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

      <table width="95%" class="header">
            <tr>
              <td style="text-align: center">Mengetahui</td>
              <td style="text-align: center">Kota Depok, {{ date("d-m-Y")}}</td>
            </tr>
            <tr>
              <td style="text-align: center">Kepala Madrasah,</td>
              <td style="text-align: center">Ka.Ur. Tata Usaha</td>
            </tr>
            <tr>
              <td 
                style="text-align: center; 
                      vertical-align:bottom" height="50px"><u><b>Jamal, S.Pd.I</u></b>
              </td>
              <td 
                style="text-align: center; 
                      vertical-align:bottom" height="50px"><u><b>Siti Mawaddah, S.Kom</u></b>
              </td>
            </tr>
            
      </table>


    </div>
  </section>

</body>

</html>