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
     
    }

    .tabeldatapendidik td {
      padding: 5px;
    }

    .tabelpresensi {
      width: 93%;
      margin-top: 10px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      border-collapse: collapse;
      padding:3px;
      margin-left: 1cm;
      margin-right: 1cm;
    }

    .tabelpresensi tr th {
      border: 1px solid ;
      padding:2px;      
      background-color: #dbdbdd;   
      font-size: 8px;   
    }

    .tabelpresensi tr td {
      border: 1px solid ;
    }

    .footer {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      padding-top: 20px;
    }

    .header {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      padding-top: 20px;
    }
    
    
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">
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

    <table class="header" style="width: 100%">
      <tr>
        <td rowspan="2" style="text-align: center">
          <img src="{{ asset('assets/img/logo_mi.png') }}" width="75%" height="75px">
        </td>
        <td>
          <span class="title" >
          REKAPITULASI PRESENSI PENDIDIK DAN TENAGA KEPENDIDIKAN<br>
          PERIODE BULAN : {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
          MADRASAH IBTIDAIYAH AL ISLAMIYAH AMZ
          <br>Jl. Jasawarga Kp. Sugutamu Rt.003/021 Kel. Baktijaya Kec. Sukmajaya Kota Depok 16418</br>
          </span>
        </td>
      </tr> 
    </table>
    <table class="tabelpresensi">
        <tr>
          <th rowspan="2">No</th>
          <th rowspan="2">Nama Pendidik</th>
          <th colspan="31">Tanggal</th>
          <th rowspan="2">Hadir</th>
          <th rowspan="2">Telat</th>
        </tr>
        <tr>
          <?php 
            for($i=1; $i<=31; $i++) {
          ?>
            <th>{{ $i }}</th>
          <?php 
          }
          ?>
        </tr>
        @foreach ($rekap as $d)
        <tr>
          <td style="text-align:center; font-size: 10px;">{{ $loop->iteration }}</td>
          <td style="font-size: 10px;">{{ $d->nama_lengkap }}</td>

            <?php 
              $totalhadir = 0;
              $totaltelat = 0;

              for($i=1; $i<=31; $i++) {
                  $tgl = "tgl_".$i;
                  
                  if(empty($d->$tgl)) {
                    $hadir = ['',''];
                    $totalhadir += 0;
                  }else{
                    $hadir = explode("-",$d->$tgl);
                    $totalhadir += 1;
                    if($hadir[0] > "07:15:00") {
                      $totaltelat += 1;
                    }
                  }
            ?>
              <td style="font-size: 10px; text-align:center">
                <span>{{ $hadir[0] }}</span>
                <!-- <span style="color:{{ $hadir[0]>"07:15:00" ? "red" : ""}}">
                  {{ $hadir[0] }}
                </span> -->
                <br>
                <span>{{ $hadir[1] }}</span>
                <!-- <span style="color:{{ $hadir[1]<"15:30:00" ? "red" : ""}}">
                  {{ $hadir[1] }}
                </span> -->
              </td>
            <?php 
            }
            ?>

            <td style="font-size: 10px; text-align:center">{{ $totalhadir }}</td>
            <td style="font-size: 10px; text-align:center">{{ $totaltelat}}</td>
        </tr>
        @endforeach

      </table>
  
    <div class="table-responsive-sm">


      <table width="100%" class="footer">
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
                style="text-align: center; vertical-align:bottom" height="50px"><u><b>Jamal, S.Pd.I</u></b>
              </td>
              <td 
                style="text-align: center; vertical-align:bottom" height="50px"><u><b>Siti Mawaddah, S.Kom</u></b>
              </td>
            </tr>
      </table>
    </div>



  </section>

</body>

</html>