@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height: 430px !important;
    }
    .datepicker-date-display {
        background-color: #0f3a7e !important;
    }

    #keterangan{
      height: 5rem !important;
    }
</style>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Ajuan Izin Tidak Hadir/Absen</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <form method="POST"  action="/izinabsen/store" id="frmizin">
            @csrf
            <!-- <div class="form-group">
                <select name="status" id="status" class="form-control">
                    <option value="">Pilih Izin/Sakit</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div> -->
            <div class="form-group">
                <input type="text" id="tgl_izin_dari" name="tgl_izin_dari" class="form-control datepicker"  placeholder="Dari tanggal">
            </div>
            <div class="form-group">
                <input type="text" id="tgl_izin_sampai" name="tgl_izin_sampai" class="form-control datepicker"  placeholder="Sampai tanggal">
            </div>
            <div class="form-group">
                <input type="text" id="jml_hari" name="jml_hari" class="form-control"  placeholder="Jumlah Hari" readonly>
            </div>
            
            <div class="form-group">
                <input type="text" id="keterangan" name="keterangan" class="form-control"  placeholder="Isi alasannya/keterangan" autocomplete="off">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block">
                    Kirim
                </button>
            </div>            
        </form>
    </div>
</div>
@endsection


@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd"    
        });

        function loadjumlahhari() {
          var dari = $("#tgl_izin_dari").val();
          var sampai = $("#tgl_izin_sampai").val();
          var date1 = new Date(dari);
          var date2 = new Date(sampai)

          // To calculate The time difference of two date
          var Difference_In_Time = date2.getTime() - date1.getTime();

          // To calculate The no of days between two date
          var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

          if(dari =="" || sampai== "") {
            var jmlhari = 0;
          }else{
            var jmlhari = Difference_In_Days + 1;
          }
          //To Display the final no of days (Result)
          $("#jml_hari").val(jmlhari + " Hari");
        }

        $("#tgl_izin_dari,#tgl_izin_sampai").change(function(e) {
        loadjumlahhari();
        });


        // $("#tgl_izin").change(function(e) {
        //     var tgl_izin = $(this).val();
        //     $.ajax({
        //         type: 'POST',
        //         url:'/presensi/cekpengajuanizin',
        //         data: {
        //             _token:"{{ csrf_token() }}",
        //             tgl_izin: tgl_izin
        //         },
        //         cache: false,
        //         success: function(respond) {
        //             if(respond==1){
        //                 Swal.fire({
        //                     title: 'Ooops !',
        //                     text: 'Anda sudah melakukan ajuan izin pada tanggal tersebut !',
        //                     icon:'warning'
        //                 }).then((result) => {
        //                    $("#tgl_izin").val(""); 
        //                 });
        //             }
        //         }
        //     });
        // }); 


        // validari inputan
        $("#frmizin").submit(function() {
            var tgl_izin_dari = $("#tgl_izin_dari").val();
            var tgl_izin_sampai = $("#tgl_izin_sampai").val();
            var keterangan = $("#keterangan").val();
            if(tgl_izin_dari == "" || tgl_izin_sampai == ""){
                Swal.fire({
                    title: 'Ooops !',
                    text: 'Tanggal harus Diisi',
                    icon:'warning'
                });
                return false;
            } else if(keterangan == ""){
                Swal.fire({
                    title: 'Ooops !',
                    text: 'Keterangan harus Diisi',
                    icon:'warning'
                });
                return false;
            }
        });

    });
</script>
@endpush