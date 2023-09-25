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
          Data Madrasah
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
                <a href="#" class="btn btn-primary mb-2" id="btnTambahMadrasah">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M16 19h6"></path>
                    <path d="M19 16v6"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                  </svg>
                 Tambah Madrasah
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-12 mb-2">
                <form action="/madrasah" method="GET">
                  <div class="row">
                    <div class="col-10">

                    <!-- form_pencarian -->
                      <select name="kode_madrasah" id="" class="form-select">
                          <option value="">Semua Madrasah</option>
                      </select>

                      <!-- <div class="form-group">
                        <input type="text" name="nama_madrasah" id="nama_madrasah" class="form-control" placeholder="Cari Madrasah" value="{{ Request('nama_madrasah') }}">
                      </div> -->
                    </div>
                    
                    <div class="col-2">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                          <path d="M21 21l-6 -6"></path>
                          </svg>
                          Cari
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="row table-responsive">
              <div class="col-12 table-responsive ">
                <table class="table table-bordered table-striped table-hover mb-2 ">
                  <thead class="table-primary">
                    <tr>
                      <th>No</th>
                      <th>N S M</th>                     
                      <th>Nama Madrasah</th>                      
                      <th>Lokasi Madrasah</th>                      
                      <th>Radius</th>                      
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($madrasah as $m)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->kode_madrasah }}</td>
                        <td>{{ $m->nama_madrasah }}</td>
                        <td>{{ $m->lokasi_madrasah }}</td>
                        <td>{{ $m->radius_madrasah }}</td>
                        <td>
                          <div class="gap-1 d-flex justify-content">
                          <a href="#" class="edit btn btn-info" kode_madrasah="{{ $m->kode_madrasah }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                              </svg>
                            </a>

                            <form action="/madrasah/{{ $m->kode_madrasah }}/delete" method="POST" style="margin-left:5px">
                            @csrf                            

                            <a href="#" class="delete-confirm btn btn-danger">
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

<!-- Form Modal TAMBAH PENDIDIK -->
<div class="modal modal-blur fade" id="modal-inputmadrasah" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
              <path d="M16 19h6"></path>
              <path d="M19 16v6"></path>
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
            </svg>
               Tambah Data Madrasah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/madrasah/store" method="POST" id="frmMadrasah" >
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
                    <input type="text" value="" id="kode_madrasah" name="kode_madrasah" class="form-control" placeholder="Tanda petik (') + 3 Digit terakhit NSM Madrasah">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                      <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                      <path d="M8 13h1v3h-1z"></path>
                      <path d="M12 13v3"></path>
                      <path d="M15 13h1v3h-1z"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="nama_madrasah" name="nama_madrasah" class="form-control" placeholder="Nama Madrasah">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                        <path d="M9 4v13"></path>
                        <path d="M15 7v5.5"></path>
                        <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                        <path d="M19 18v.01"></path>
                      </svg>
                  </span>
                    <input type="text" value="" id="lokasi_madrasah" name="lokasi_madrasah" class="form-control" placeholder="Lokasi Latitude dan Longitude Madrasah">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-broadcast-tower" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        <path d="M16.616 13.924a5 5 0 1 0 -9.23 0"></path>
                        <path d="M20.307 15.469a9 9 0 1 0 -16.615 0"></path>
                        <path d="M9 21l3 -9l3 9"></path>
                        <path d="M10 19h4"></path>
                      </svg>
                  </span>
                    <input type="text" value="" id="radius_madrasah" name="radius_madrasah" class="form-control" placeholder="Radius diperbolehkan untuk Absen (skala meter)">
                  </div>
                </div>
              </div>

              <div class="row mt-3">
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
<div class="modal modal-blur fade" id="modal-editmadrasah" tabindex="-1" role="dialog" aria-hidden="true">
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
               Edit Data Madrasah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">

          </div>
        </div>
      </div>
    </div>
<!-- END MODAL EDIT -->

@endsection

@push('myscript')
<script>
  $(function() {
    $("#btnTambahMadrasah").click(function() {
      // alert('test');
      $("#modal-inputmadrasah").modal("show");
    });

    $(".edit").click(function() {
      var kode_madrasah = $(this).attr('kode_madrasah');
      $.ajax({
          type: 'POST',
          url: '/madrasah/edit',
          data:{
            _token: "{{ csrf_token(); }}",
            kode_madrasah: kode_madrasah
          },
          success:function(respond){
            $("#loadeditform").html(respond);
          }
      });      
      $("#modal-editmadrasah").modal("show");      
    });

      $(".delete-confirm").click(function(e) {
          var form = $(this).closest('form');
          e.preventDefault();
          Swal.fire({
            title: 'Anda Yakin Mau menghapus Data ini?',
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
  
      $("#frmMadrasah").submit(function() {
        // ditampung oleh nik
        var kode_madrasah = $("#kode_madrasah").val();
        var nama_madrasah = $("#nama_madrasah").val();
        var lokasi_madrasah = $("#lokasi_madrasah").val();
        var radius_madrasah = $("#radius_madrasah").val();        

        if(kode_madrasah == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Kode Madrasah harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#kode_madrasah").focus();
            });
              return false;
          } else if(nama_madrasah  == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Nama Madrasah harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#nama_madrasah ").focus();
            });
              return false;
          } else if(lokasi_madrasah == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Lokasi Madrasah harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#lokasi_madrasah").focus();
            });
              return false;
          } else if(radius_madrasah == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Radius Madrasah harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#radius_madrasah").focus();
            });
              return false;
          }
    });


  });
</script>

@endpush