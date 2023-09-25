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
          Konfigurasi Jam Kerja
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
          <div class="card-body table-responsive">
            <div class="row">
              <div class="col-12">
                
                  @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                  @endif

                  @if(Session::get('warning'))
                    <div class="alert alert-warning">
                          {{ Session::get('warning') }}
                    </div>
                  @endif
                
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <a href="#" class="btn btn-primary mb-2" id="btnTambahJamKerja">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M20.984 12.535a9 9 0 1 0 -8.468 8.45"></path>
                  <path d="M16 19h6"></path>
                  <path d="M19 16v6"></path>
                  <path d="M12 7v5l3 3"></path>
                </svg>
                 Tambah Data Jam Kerja
                </a>
              </div>
            </div>

            <div class="row table-responsive">
              <div class="col-12 table-responsive ">
                <table class="table table-bordered table-striped table-hover mb-2 ">
                  <thead class="table-primary">
                    <tr>
                      <th>No</th>
                      <th>Kode Jam Kerja</th>                     
                      <th>Nama Jam Kerja</th>                      
                      <th>Awal Jam Masuk</th>                      
                      <th>Jam Masuk</th>                      
                      <th>Akhir Jam Masuk</th>                      
                      <th>Jam Pulang</th>                      
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jam_kerja as $d)
                      <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $d->kode_jam_kerja}}</td>
                        <td>{{ $d->nama_jam_kerja}}</td>
                        <td>{{ $d->awal_jam_masuk}}</td>
                        <td>{{ $d->jam_masuk}}</td>
                        <td>{{ $d->akhir_jam_masuk}}</td>
                        <td>{{ $d->jam_pulang}}</td>
                        <td>
                          <div class="gap-1 d-flex justify-content">
                            <a href="#" class="edit btn btn-info btn-sm" kode_jam_kerja="{{ $d->kode_jam_kerja }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                  <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                  <path d="M16 5l3 3"></path>
                                </svg>
                              </a>

                            <form action="/konfigurasi/{{ $d->kode_jam_kerja }}/deletejamkerja" method="POST" style="margin-left:5px">
                            @csrf                            

                            <a href="#" class="delete-confirm btn btn-danger btn-sm">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                              </svg>
                            </a>
                          </form>
                          </div>
                        </td>
                      </tr>

                    @endforeach
                   
                    
                  </tbody>
                </table>                
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Form Modal TAMBAH JAM KERJA -->
<div class="modal modal-blur fade" id="modal-inputjk" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M20.984 12.535a9 9 0 1 0 -8.468 8.45"></path>
              <path d="M16 19h6"></path>
              <path d="M19 16v6"></path>
              <path d="M12 7v5l3 3"></path>
            </svg>
               Tambah Data Jam Kerja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/konfigurasi/storejamkerja" method="POST" id="frmJK" >
              @csrf

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                      <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                      <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                      <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                      <path d="M5 12l14 0"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="kode_jam_kerja" name="kode_jam_kerja" class="form-control" placeholder="Kode Jam Kerja">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-heart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M20.956 11.107a9 9 0 1 0 -9.579 9.871"></path>
                      <path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z"></path>
                      <path d="M12 7v5l.5 .5"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="nama_jam_kerja" name="nama_jam_kerja" class="form-control" placeholder="Nama Jam Kerja">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M20.943 13.016a9 9 0 1 0 -8.915 7.984"></path>
                    <path d="M16 22l5 -5"></path>
                    <path d="M21 21.5v-4.5h-4.5"></path>
                    <path d="M12 7v5l2 2"></path>
                  </svg>
                  </span>
                    <input type="text" value="" id="awal_jam_masuk" name="awal_jam_masuk" class="form-control" placeholder="Awal Jam Masuk">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M20.943 13.016a9 9 0 1 0 -8.915 7.984"></path>
                      <path d="M16 22l5 -5"></path>
                      <path d="M21 21.5v-4.5h-4.5"></path>
                      <path d="M12 7v5l2 2"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="jam_masuk" name="jam_masuk" class="form-control" placeholder="Jam Masuk">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M20.943 13.016a9 9 0 1 0 -8.915 7.984"></path>
                      <path d="M16 22l5 -5"></path>
                      <path d="M21 21.5v-4.5h-4.5"></path>
                      <path d="M12 7v5l2 2"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="akhir_jam_masuk" name="akhir_jam_masuk" class="form-control" placeholder="Akhir Jam Masuk">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20.943 13.016a9 9 0 1 0 -8.915 7.984"></path>
                        <path d="M16 22l5 -5"></path>
                        <path d="M21 21.5v-4.5h-4.5"></path>
                        <path d="M12 7v5l2 2"></path>
                      </svg>
                      </span>
                    <input type="text" value="" id="jam_pulang" name="jam_pulang" class="form-control" placeholder="Jam Pulang">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <button class="btn btn-primary w-100"> 
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M10 14l11 -11"></path>
                      <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                    </svg>  
                    Simpan
                    </button>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
<!-- END MODAL TAMBAH -->

<!-- Form Modal EDIT-->
<div class="modal modal-blur fade" id="modal-editjk" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
          <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>
          <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>
        </svg>
            Edit Data Jam Kerja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="loadeditform">

      </div>
    </div>
  </div>
</div>
<!-- END MODAL EDIT -->

<!-- END MODAL EDIT -->

</div>
@endsection

@push('myscript')
<script>
$(function() {
    //validasi inputan form
    $("#awal_jam_masuk, #jam_masuk, #akhir_jam_masuk, #jam_pulang").mask("00:00");

    $("#btnTambahJamKerja").click(function() {
      // alert('test');
      $("#modal-inputjk").modal("show");
    });

    $(".edit").click(function() {
      var kode_jam_kerja = $(this).attr('kode_jam_kerja');
      $.ajax({
          type: 'POST',
          url: '/konfigurasi/editjamkerja',
          data:{
            _token: "{{ csrf_token(); }}",
            kode_jam_kerja: kode_jam_kerja
          },
          success:function(respond){
            $("#loadeditform").html(respond);
          }
      });      
      $("#modal-editjk").modal("show");      
    });

      $(".delete-confirm").click(function(e) {
          var form = $(this).closest('form');
          e.preventDefault();
          Swal.fire({
            title: 'Anda Yakin Mau menghapus Data Jam Kerja ini?',
            text: "Jika Ya maka data akan terhapus secara permanent!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Hapus Az!'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
              Swal.fire(
                'Deleted!',
                'Alhamdulillah, Data Telah Berhasil Dihapus.',
                'success'
              )
            }
          })
      });

    $("#frmJK").submit(function() {
        // ditampung oleh nik
        var kode_jam_kerja = $("#kode_jam_kerja").val();
        var nama_jam_kerja = $("#nama_jam_kerja").val();
        var awal_jam_masuk = $("#awal_jam_masuk").val();
        var jam_masuk   	  = $("#jam_masuk").val();
        var akhir_jam_masuk = $("#akhir_jam_masuk").val();
        var jam_pulang      = $("#jam_pulang").val();
             
        if(kode_jam_kerja == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Kode Jam Kerja harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#kode_jam_kerja").focus();
            });
              return false;
          } else if(nama_jam_kerja  == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Nama Jam Kerja harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#nama_jam_kerja ").focus();
            });
              return false;
          } else if(awal_jam_masuk == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Awal Jam Masuk harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#awal_jam_masuk").focus();
            });
              return false;
          } else if(jam_masuk == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Jam Masuk harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#jam_masuk").focus();
            });
              return false;
          } else if(akhir_jam_masuk == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Akhir Jam Masuk harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#akhir_jam_masuk").focus();
            });
              return false;
          } else if(jam_pulang == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Jam Pulang harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#jam_pulang").focus();
            });
              return false;
          } 
    });



  });

</script>
@endpush