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
          Data Master Cuti
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
                <a href="#" class="btn btn-primary mb-2" id="btnTambahCuti">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-invoice" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                  <path d="M9 7l1 0"></path>
                  <path d="M9 13l6 0"></path>
                  <path d="M13 17l2 0"></path>
                </svg>
                Tambah Data Master Cuti
                </a>
              </div>
            </div>        

            <div class="row table-responsive">
              <div class="col-12 table-responsive ">
                <table class="table table-bordered table-striped table-hover mb-2 ">
                  <thead class="table-primary">
                    <tr>
                      <th>No</th>
                      <th>Kode Cuti</th>                     
                      <th>Nama Cuti</th>                      
                      <th>Jumlah Hari</th>                      
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach( $cuti as $d)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($d->kode_cuti) }}</td>
                        <td>{{ $d->nama_cuti }}</td>
                        <td>{{ $d->jml_hari }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="#" class="edit btn btn-info btn-sm" kode_cuti="{{ $d->kode_cuti }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                              </svg>
                            </a>
                            
                            <form action="/cuti/{{ $d->kode_cuti }}/delete" method="POST" style="margin-left:5px">
                              @csrf                            

                              <a href="#" class="delete-confirm btn btn-danger btn-sm ">
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
<div class="modal modal-blur fade" id="modal-inputcuti" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-invoice" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
              <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
              <path d="M9 7l1 0"></path>
              <path d="M9 13l6 0"></path>
              <path d="M13 17l2 0"></path>
            </svg>
               Tambah Master Cuti</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/cuti/store" method="POST" id="frmCuti" >
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
                    <input type="text" value="" id="kode_cuti" name="kode_cuti" class="form-control" placeholder="Kode Cuti" autocomplete="off">
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
                    <input type="text" value="" id="nama_cuti" name="nama_cuti" class="form-control" placeholder="Nama Cuti" autocomplete="off">
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
                    <input type="text" value="" id="jml_hari" name="jml_hari" class="form-control" placeholder="Jumlah Hari" autocomplete="off">
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
<div class="modal modal-blur fade" id="modal-editcuti" tabindex="-1" role="dialog" aria-hidden="true">
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
               Edit Master Cuti</h5>
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
    $("#btnTambahCuti").click(function() {
      // alert('test');
      $("#modal-inputcuti").modal("show");
    });

    $(".edit").click(function() {
      var kode_cuti = $(this).attr('kode_cuti');
      $.ajax({
          type: 'POST',
          url: '/cuti/edit',
          data:{
            _token: "{{ csrf_token(); }}",
            kode_cuti: kode_cuti
          },
          success:function(respond){
            $("#loadeditform").html(respond);
          }
      });      
      $("#modal-editcuti").modal("show");      
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


      $("#frmCuti").submit(function() {
        // ditampung oleh nik
        var kode_cuti = $("#kode_cuti").val();
        var nama_cuti = $("#nama_cuti").val();
        var jml_hari = $("#jml_hari").val();
   
        if(kode_cuti == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Kode Cuti harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#kode_cuti").focus();
            });
              return false;
          } else if(nama_cuti  == ""){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Nama Cuti harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#nama_cuti ").focus();
            });
              return false;
          } else if(jml_hari == "" || jml_hari == 0){
          // alert('NIK harus diisi');
          Swal.fire({
            title: 'Warning !',
            text: 'Jumlah Hari harus Diisi',
            icon: 'warning',
            confirmButtonText: 'OK'
            }).then ((result) => {
              $("#jml_hari").focus();
            });
              return false;
          } 
    });


  });
</script>

@endpush