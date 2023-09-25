<form action="/konfigurasi/updatejamkerja" method="POST" id="frmJK" >
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
        <input type="text" value="{{ $jam_kerja->kode_jam_kerja }}" id="kode_jam_kerja" name="kode_jam_kerja" class="form-control" placeholder="Kode Jam Kerja">
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
        <input type="text" value="{{ $jam_kerja->nama_jam_kerja }}" id="nama_jam_kerja" name="nama_jam_kerja" class="form-control" placeholder="Nama Jam Kerja">
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
        <input type="text" value="{{ $jam_kerja->awal_jam_masuk }}" id="awal_jam_masuk" name="awal_jam_masuk" class="form-control" placeholder="Awal Jam Masuk">
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
        <input type="text" value="{{ $jam_kerja->jam_masuk }}" id="jam_masuk" name="jam_masuk" class="form-control" placeholder="Jam Masuk">
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
        <input type="text" value="{{ $jam_kerja->akhir_jam_masuk }}" id="akhir_jam_masuk" name="akhir_jam_masuk" class="form-control" placeholder="Akhir Jam Masuk">
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
        <input type="text" value="{{ $jam_kerja->jam_pulang }}" id="jam_pulang" name="jam_pulang" class="form-control" placeholder="Jam Pulang">
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
        Update
        </button>
      </div>
    </div>
  </div>

</form>