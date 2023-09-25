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
          Data Pendidik
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
                <a href="#" class="btn btn-primary mb-2" id="btnTambahPendidik">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M16 19h6"></path>
                    <path d="M19 16v6"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                  </svg>
                 Tambah Pendidik
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-12 mb-2">
                <form action="/pendidik" method="GET">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <input type="text" name="nama_pendidik" id="nama_pendidik" class="form-control" placeholder="Cari Nama Pendidik" value="{{ Request('nama_pendidik') }}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <select name="kode_dept" id="kode_dept" class="form-select">
                          <option value="">-Status Pendidik-</option>
                          @foreach($departemen as $d)
                            <option {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                          @endforeach
                        </select>
                      </div>
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
              <div class="col-12 ">
                <table class="table table-bordered table-striped table-hover mb-2 ">
                  <thead class="table-light ">
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">NIK</th>
                      <th class="text-center">NUPTK</th>
                      <th class="text-center">Nama Lengkap</th>
                      <th class="text-center">Jabatan</th>
                      <th class="text-center">N0 HP</th>
                      <th class="text-center">Photo</th>
                      <th class="text-center">Asal Madrasah</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pendidik as $d)
                    @php
                      $path = Storage::url('uploads/pendidik/'.$d->foto);
                      
                    @endphp
                      <tr>
                        <td>{{ $loop->iteration + $pendidik->firstItem()-1 }}</td>
                        <td>{{ $d->nik }}</td>
                        <td>{{ $d->nuptk }}</td>
                        <td>{{ $d->nama_lengkap }}</td>
                        <td>{{ $d->jabatan }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>
                        @if(empty($d->foto))
                            <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar"  alt="">
                          @else
                            <img src="{{ url($path) }}" class="avatar"  alt="">
                          @endif
                        </td>
                       
                       
                        <td class="text-center">{{ $d->kode_madrasah }} </td>
                        <td>{{ $d->nama_dept }}</td>
                        <td>
                          <div class="gap-1 d-flex justify-content">
                          <a href="#" class="edit btn btn-info" nik="{{ $d->nik }}">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                              <path d="M16 5l3 3"></path>
                            </svg>
                          </a>

                          <a href="/konfigurasi/{{ $d->nik }}/setjamkerja" class="btn btn-success ml-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M12.483 20.935c-.862 .239 -1.898 -.178 -2.158 -1.252a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.08 .262 1.496 1.308 1.247 2.173"></path>
                              <path d="M16 19h6"></path>
                              <path d="M19 16v6"></path>
                              <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            </svg>
                          </a>
                          
                            <form action="/pendidik/{{ $d->nik }}/delete" method="POST" style="margin-left:1px">
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
                {{ $pendidik->links() }}
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Form Modal TAMBAH PENDIDIK -->
<div class="modal modal-blur fade" id="modal-inputpendidik" tabindex="-1" role="dialog" aria-hidden="true">
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
               Tambah Data Pendidik</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/pendidik/store" method="POST" id="frmPendidik" enctype="multipart/form-data" >
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
                    <input type="text" value="" id="nik" name="nik" class="form-control" placeholder="NIK">
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
                    <input type="text" value="" id="nuptk" name="nuptk" class="form-control" placeholder="NUPTK">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-square" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M9 10a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                      <path d="M6 21v-1a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v1"></path>
                      <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                  <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                      <path d="M15 6h6m-3 -3v6"></path>
                    </svg>
                  </span>
                    <input type="text" value="" id="no_hp" name="no_hp" class="form-control" placeholder="No HP">
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-12">
                  <div class="form-group">
                    <select name="kode_madrasah" id="kode_madrasah" class="form-select" name="kode_madrasah">
                    <option value="">Pilih Madrasah</option>
                    @foreach($madrasah as $d)
                    <option value="{{ $d->kode_madrasah }}">{{ strtoupper($d->nama_madrasah) }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-12">
                  <div class="form-group">
                    <select name="kode_dept" id="kode_dept" class="form-select" name="kode_dept">
                    <option value="">Pilih Status</option>
                    @foreach($departemen as $d)
                    <option value="{{ $d->kode_dept }}">{{ strtoupper($d->nama_dept) }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12">
                  <input type="file" class="form-control" id="foto" name="foto">
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
<div class="modal modal-blur fade" id="modal-editpendidik" tabindex="-1" role="dialog" aria-hidden="true">
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
               Edit Data Pendidik</h5>
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
    // validasi form
    $("#nik").mask("0000000000000000");
    $("#nuptk").mask("0000000000000000");
    $("#no_hp").mask("+62|000-0000-0000");

    $("#btnTambahPendidik").click(function() {
      // alert('test');
      $("#modal-inputpendidik").modal("show");
    });

    $(".edit").click(function() {
      var nik = $(this).attr('nik');
      $.ajax({
          type: 'POST',
          url: '/pendidik/edit',
          data:{
            _token: "{{ csrf_token(); }}",
            nik: nik
          },
          success:function(respond){
            $("#loadeditform").html(respond);
          }
      });      
      $("#modal-editpendidik").modal("show");      
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

      $("#frmPendidik").submit(function() {
        // ditampung oleh nik
        var nik = $("#nik").val();
        var nuptk = $("#nuptk").val();
        var nama_lengkap = $("#nama_lengkap").val();
        var jabatan = $("#jabatan").val();
        var no_hp = $("#no_hp").val();
        var kode_dept = $("frmPendidik").find("#kode_dept").val();  // kode_dept dibedakan dengan search
        var foto = $("#foto").val();
        // var password = $("#password").val();

        if(nik == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'NIK harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#nik").focus();
            });
              return false;
          } else if (nuptk == "") {
            Swal.fire({
            title: 'Warning !',
            text: 'NUPTK harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#nuptk").focus();
            });
              return false;
          } else if (nama_lengkap == "") {
            Swal.fire({
            title: 'Warning !',
            text: 'Nama Lengkap harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#nama_lengkap").focus();
            });
              return false;
          } else if (jabatan == "") {
            Swal.fire({
            title: 'Warning !',
            text: 'Jabatan harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#jabatan").focus();
            });
              return false;
          } else if (no_hp == "") {
            Swal.fire({
            title: 'Warning !',
            text: 'No Handphone harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#no_hp").focus();
            });
              return false;
          } else if (kode_dept == "") {
            Swal.fire({
            title: 'Warning !',
            text: 'Status harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#kode_dept").focus();
            });
              return false;
          }
    });

  });
</script>

@endpush