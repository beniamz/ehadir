@extends('layouts.admin.tabler')
@section('content')

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title 
        <div class="page-pretitle">
          Pendidik
        </div>
        -->
        <h2 class="page-title">
          Monitoring Presensi
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6"></path>
                      <path d="M16 3v4"></path>
                      <path d="M8 3v4"></path>
                      <path d="M4 11h16"></path>
                      <path d="M15 19l2 2l4 -4"></path>
                    </svg>
                  </span>
                  <input type="text" value="" id="tanggal" name="tanggal" class="form-control" placeholder="Pilih Tanggal Presensi" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="row mt-2" >
              <div class="col-12 table-responsive">
                <table class="table table-hover  table-strip table-responsive">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIK</th>
                      <th>Nuptk</th>
                      <th>Nama nama_lengkap</th>
                      <th>Status</th>
                      <th>Absen Masuk</th>
                      <th>Foto In</th>
                      <th>Absen Pulang</th>
                      <th>Foto Out</th>
                      <th>keterangan</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="loadpresensi" class="table-responsive"></tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Form Modal EDIT-->
<div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M11 18l-2 -1l-6 3v-13l6 -3l6 3l6 -3v9"></path>
              <path d="M9 4v13"></path>
              <path d="M15 7v8"></path>
              <path d="M15 19l2 2l4 -4"></path>
            </svg>
               Lokasi Presensi User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadmap">

          </div>
        </div>
      </div>
    </div>
<!-- END MODAL EDIT -->
@endsection
@push('myscript')
<script>
  $(function () {
    $("#tanggal").datepicker({ 
          autoclose: true, 
          todayHighlight: true,
          format:"yyyy-mm-dd"
          // .datepicker('update', new Date())
    }).datepicker('update', new Date());
    
    function loadpresensi() {
      var tanggal = $("#tanggal").val();
        $.ajax({
          type: 'POST',
          url: '/getpresensi',
          data:{
            _token: "{{ csrf_token(); }}",
            tanggal: tanggal
          },
          catch:false,
          success: function(respond) {
              $("#loadpresensi").html(respond);
          }
        });
    }

    $("#tanggal").change(function(e) {
      loadpresensi();
    });
      loadpresensi();


  });
</script>
@endpush