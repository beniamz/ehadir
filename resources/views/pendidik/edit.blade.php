<form action="/pendidik/{{ $pendidik->nik }}/update" method="POST" id="frmPendidik" enctype="multipart/form-data" >
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
        <input type="text" readonly value="{{ $pendidik->nik }}" id="nik" name="nik" class="form-control" placeholder="NIK">
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
        <input type="text" value="{{ $pendidik->nuptk }}" id="nuptk" name="nuptk" class="form-control" placeholder="NUPTK">
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
        <input type="text" value="{{ $pendidik->nama_lengkap }}" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
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
        <input type="text" value="{{ $pendidik->jabatan }}" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan">
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
        <input type="text" value="{{ $pendidik->no_hp }}" id="no_hp" name="no_hp" class="form-control" placeholder="No HP">
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12">
      <div class="form-group">
        <select name="kode_dept" id="kode_dept" class="form-select">
        <option value="">-Pilih Status-</option>
        @foreach($departemen as $d)
        <option {{ $pendidik->kode_dept == $d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
        @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12">
      <input type="file" class="form-control" id="foto" name="foto">
      <input type="hidden" name="old_foto" value="{{ $pendidik->foto }}">
    </div>                
  </div>

  <div class="row mt-3">
    <div class="col-12">
      <div class="form-group">
        <button class="btn btn-primary w-100"> 
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>
            <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>
          </svg> 
          Update
        </button>
      </div>
    </div>
  </div>

</form>