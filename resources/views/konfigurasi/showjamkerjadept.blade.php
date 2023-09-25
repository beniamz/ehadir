@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">        
        <a href="/konfigurasi/jamkerjadept" class=" btn btn-sm page-pretitle">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
          </svg>
          kembali
        </a>
        <h2 class="page-title mt-3">
          Data Jam Kerja Pendidik Berdasarkan Statusnya
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">

    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <select name="kode_madrasah" id="kode_madrasah" class="form-select" disabled>
                <option value="">Pilih Madrasah</option>
                @foreach( $madrasah as $d )
                <option {{ $jamkerjadept->kode_madrasah  == $d->kode_madrasah ? 'selected' : '' }} value="{{ $d->kode_madrasah }}">{{  strtoupper($d->nama_madrasah) }} </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <select name="kode_dept" id="kode_dept" class="form-select" disabled>
                <option value="">Pilih Status Guru</option>
                @foreach( $departemen as $d )
                <option {{ $jamkerjadept->kode_dept  == $d->kode_dept ? 'selected' : '' }}  value="{{ $d->kode_dept }}">{{ strtoupper($d->nama_dept) }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-5">
        <div class="card">
          <div class="card-body table-responsive">
              <table class="table ">
              <thead>
                <tr>
                  <th>Hari</th>
                  <th>Jam Kerja</th>
                </tr>
              </thead>
              <tbody>
                @foreach($jamkerjadeptdetail as $s)
                  <tr>
                    <td>
                      {{ $s->hari}}
                      <input type="hidden" name="hari[]" value="{{ $s->hari }}">
                    </td>
                    <td>
                      {{ $s->nama_jam_kerja }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          
          </div>
        </div>
      </div>

      <div class="col-7">
        <table class="table">
            <thead>
              <tr>
                <th class="text-center" colspan="6">MASTER JAM KERJA</th>
              </tr>
              <tr>
                <th class="text-center">Kode</th>
                <th class="text-center">Nama Jam Kerja</th>
                <th class="text-center">Awal Jam Masuk</th>
                <th class="text-center">Jam Masuk</th>
                <th class="text-center">Akhir Jam Masuk</th>
                <th class="text-center">Jam Pulang</th>
              </tr>
            </thead>
            <tbody>
              @foreach($jamkerja as $d)
              <tr>
                <td class="text-center">{{ $d->kode_jam_kerja }}</td>
                <td class="text-center">{{ $d->nama_jam_kerja }}</td>
                <td class="text-center">{{ $d->awal_jam_masuk }}</td>
                <td class="text-center">{{ $d->jam_masuk }}</td>
                <td class="text-center">{{ $d->akhir_jam_masuk }}</td>
                <td class="text-center">{{ $d->jam_pulang }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection