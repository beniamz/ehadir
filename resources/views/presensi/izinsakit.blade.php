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
          Pengajuan Izin Sakit
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <!--fungsi pencarian izin sakit -->
    <div class="row">
      <div class="col-12">
        <form action="/presensi/izinsakit" method="GET" autocomplete="off">
          <div class="row">

            <div class="col-6">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path>
                    <path d="M16 3v4"></path>
                    <path d="M8 3v4"></path>
                    <path d="M4 11h16"></path>
                    <path d="M16 19h6"></path>
                    <path d="M19 16v6"></path>
                  </svg>
                </span>
                  <input type="text" value="{{ Request('dari') }}" id="dari" name="dari" class="form-control" placeholder="dari Tanggal">
                </div>
            </div>

            <div class="col-6">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path>
                    <path d="M16 3v4"></path>
                    <path d="M8 3v4"></path>
                    <path d="M4 11h16"></path>
                    <path d="M16 19h6"></path>
                    <path d="M19 16v6"></path>
                  </svg>
                </span>
                  <input type="text" value="{{ Request('sampai') }}" id="sampai" name="sampai" class="form-control" placeholder="sampai Tanggal">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-3">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                    <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                    <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                    <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                    <path d="M5 11h1v2h-1z"></path>
                    <path d="M10 11l0 2"></path>
                    <path d="M14 11h1v2h-1z"></path>
                    <path d="M19 11l0 2"></path>
                  </svg>
                </span>
                  <input type="text" value="{{ Request('nik') }}"" id="nik" name="nik" class="form-control" placeholder=" isi dengan nik">
              </div>
            </div>
            <div class="col-3">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5"></path>
                    <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                    <path d="M20.2 20.2l1.8 1.8"></path>
                  </svg>
                </span>
                  <input type="text" value="{{ Request('nama_lengkap') }}"" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Isi dengan Nama Pendidik">
              </div>
            </div>
            <div class="col-3">
              <div class="mb-3 form-group">                
                <select type="text" value="" id="status_approved" name="status_approved" class="form-select">
                  <option value="">Piih Status Approved</option>
                  <option value="0" {{ Request('status_approved') === '0' ? 'selected' : '' }}>Pending</option>
                  <option value="1" {{ Request('status_approved') == 1 ? 'selected' : '' }}>Disetujui</option>
                  <option value="2" {{ Request('status_approved') == 2 ? 'selected' : '' }}>Ditolak</option>
                </select>
              </div>
            </div>

            <div class="col-3">
              <div class="mb-3 form-group">                
                <button class="btn btn-primary" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                    <path d="M21 21l-6 -6"></path>
                  </svg>
                   Cari Data
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>    

    <!--Tampilkan data izin sakit -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body table-responsive">
          <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>NIK</th>
              <th>Nama Pendidik</th>
              <th>Jabatan</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Status Approve</th>
              <th>Action</th>              
            </tr>
          </thead>
          <tbody>
            @foreach($izinsakit as $d)
              <tr>
                <td>{{ $loop->iteration + $izinsakit->firstItem()-1 }}</td>
                <td>{{ date('d-m-Y', strtotime($d->tgl_izin)) }}</td>
                <td>{{ $d->nik }}</td>
                <td>{{ $d->nama_lengkap }}</td>
                <td>{{ $d->jabatan }}</td>
                <td>{{ $d->status == "i" ? "Izin" : "Sakit" }}</td>
                <td>{{ $d->keterangan }}</td>
                <td>
                  @if($d->status_approved==1)
                    <span class="badge bg-success">Disetujui</span>
                  @elseif($d->status_approved==2)
                    <span class="badge bg-danger">Ditolak</span>
                  @else
                    <span class="badge bg-warning">Waiting Approved</span>
                  @endif
                </td>
                <td>
                  @if($d->status_approved==0)
                  <a href="#" class="btn btn-primary btn-sm" id="approve" id_izinsakit="{{ $d->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                      <path d="M11 13l9 -9"></path>
                      <path d="M15 4h5v5"></path>
                    </svg>                    
                  </a>
                  @else
                  <a href="/presensi/{{ $d->id }}/batalkanizinsakit" class="btn btn-danger btn-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                      <path d="M9 9l6 6m0 -6l-6 6"></path>
                    </svg>
                    Batalkan
                  </a>
                  @endif
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
        {{ $izinsakit->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
               Form Status Persetujuan Izin Sakit
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="/presensi/approveizinsakit" method="POST">
             @csrf

              <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="form-group">
                        <select name="status_approved" id="status_approved" class="form-select">
                          <option value="1">Disetujui</option>
                          <option value="2">Ditolak</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <button class="btn btn-primary btn-sm mt-3 w-100" type="submit" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-telegram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"></path>
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
<!-- END MODAL EDIT -->
@endsection

@push('myscript')
<script>
  $(function(){
    $("#approve").click(function(e) {
      e.preventDefault();
      var id_izinsakit = $(this).attr("id_izinsakit");
      $("#id_izinsakit_form").val(id_izinsakit);
      $("#modal-izinsakit").modal("show");
    }); 

    $("#dari, #sampai").datepicker({ 
          autoclose: true, 
          todayHighlight: true,
          format:"yyyy-mm-dd"
    }); // .datepicker('update', new Date()) --> menampilkan tanggal sekarang


  }); 
</script>

@endpush