@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col mb-3">        
        <a href="/pendidik" class=" btn btn-sm page-pretitle">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
          </svg>
          kembali
        </a>
        <h2 class="page-title mt-3">
          Setting Jam Kerja Pendidik
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">

    <div class="row">
      <div class="col-12">
        <table class="table">
            <tr>
              <th>NIK </th>
              <th>: {{ $pendidik->nik }}</th>
            </tr>
            <tr>
              <td>Nama Lengkap </td>
              <td>: {{ $pendidik->nama_lengkap }}</td>
            </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-5">
        <div class="card">
          <div class="card-body table-responsive">

            <form action="/konfigurasi/storesetjamkerja" method="POST">
              @csrf
              <input type="hidden" name="nik" value="{{ $pendidik->nik }}">

              <table class="table ">
              <thead>
                <tr>
                  <th>Hari</th>
                  <th>Jam Kerja</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>Senin
                      <input type="hidden" name="hari[]" value="Senin">
                    </td>
                    <td>
                      <select name="kode_jam_kerja[]" id="kode_jam_kerja" class="form-select">
                        <option value="">Pilih Jam Kerja</option>
                        @foreach($jamkerja as $d)
                        <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                        @endforeach
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Selasa                       
                      <input type="hidden" name="hari[]" value="Selasa">
                    </td>
                    <td><select name="kode_jam_kerja[]" id="kode_jam_kerja" class="form-select">
                        <option value="">Pilih Jam Kerja</option>
                        @foreach($jamkerja as $d)
                        <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                        @endforeach
                      </select></td>
                  </tr>
                  <tr>
                    <td>Rabu
                      <input type="hidden" name="hari[]" value="Rabu">
                    </td>
                    <td><select name="kode_jam_kerja[]" id="kode_jam_kerja" class="form-select">
                        <option value="">Pilih Jam Kerja</option>
                        @foreach($jamkerja as $d)
                        <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                        @endforeach
                      </select></td>
                  </tr>
                  <tr>
                    <td>Kamis
                      <input type="hidden" name="hari[]" value="Kamis">
                    </td>
                    <td><select name="kode_jam_kerja[]" id="kode_jam_kerja" class="form-select">
                        <option value="">Pilih Jam Kerja</option>
                        @foreach($jamkerja as $d)
                        <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                        @endforeach
                      </select></td>
                  </tr>
                  <tr>
                    <td>Jumát
                      <input type="hidden" name="hari[]" value="Jumát">
                    </td>
                    <td><select name="kode_jam_kerja[]" id="kode_jam_kerja" class="form-select">
                        <option value="">Pilih Jam Kerja</option>
                        @foreach($jamkerja as $d)
                        <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                        @endforeach
                      </select></td>
                  </tr>
                  <tr>
                    <td>Sabtu
                      <input type="hidden" name="hari[]" value="Sabtu">
                    </td>
                    <td><select name="kode_jam_kerja[]" id="kode_jam_kerja" class="form-select">
                        <option value="">Pilih Jam Kerja</option>
                        @foreach($jamkerja as $d)
                        <option value="{{ $d->kode_jam_kerja }}">{{ $d->nama_jam_kerja }}</option>
                        @endforeach
                      </select></td>
                  </tr>
              </tbody>
            </table>
            <button class="btn btn-sm btn-primary w-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 14l11 -11"></path>
                <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
              </svg>
              Simpan Jam Kerja
            </button>
            </form>

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