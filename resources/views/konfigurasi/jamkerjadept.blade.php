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
          Konfigurasi Jam Kerja Madrasah
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">

  <div class="container-xl">
    <div class="row">
      <div class="col-10">
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
                <a href="/konfigurasi/jamkerjadept/create" class="btn btn-primary mb-2" id="btnTambahJamKerja">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M20.984 12.535a9 9 0 1 0 -8.468 8.45"></path>
                  <path d="M16 19h6"></path>
                  <path d="M19 16v6"></path>
                  <path d="M12 7v5l3 3"></path>
                </svg>
                 Tambah Data Jam Kerja Madrasah
                </a>
              </div>
            </div>

            <div class="row table-responsive">
              <div class="col-12 table-responsive ">
                <table class="table table-bordered table-striped table-hover mb-2 ">
                  <thead class="table-primary">
                    <tr>
                      <th>No</th>
                      <th>Kode</th>                     
                      <th>Nama Madrasah</th>                      
                      <th>Status Pendidik</th>  
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jamkerjadept as $d)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($d->kode_jk_dept) }}</td>
                        <td>{{ $d->nama_madrasah }}</td>
                        <td>{{ $d->nama_dept }}</td>
                        <td>
                        <div class="gap-1 d-flex justify-content">
                          <a href="/konfigurasi/jamkerjadept/{{ $d->kode_jk_dept }}/edit" class="edit btn btn-info" >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                              <path d="M16 5l3 3"></path>
                            </svg>
                          </a>

                          <a href="/konfigurasi/jamkerjadept/{{ $d->kode_jk_dept }}/show" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                              <path d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032"></path>
                              <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                          </a>

                          <a href="/konfigurasi/jamkerjadept/{{ $d->kode_jk_dept }}/delete" class="btn btn-danger delete-confirm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M4 7l16 0"></path>
                              <path d="M10 11l0 6"></path>
                              <path d="M14 11l0 6"></path>
                              <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                              <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                          </a>
                          
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

</div>
@endsection

@push('myscript')
<script>
  $(function() {
    $(".delete-confirm").click(function(e) {
          var url = $(this).attr('href');
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
              window.location.href = url;
              Swal.fire(
                'Deleted!',
                'Alhamdulillah, Data Telah Berhasil Dihapus.',
                'success'
              )
            }
          })
      });
  });
</script>
@endpush
