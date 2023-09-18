<form action="/departemen/{{ $departemen->kode_dept }}/update" method="POST" id="frmDepartemen" >
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
        <input type="text" readonly value="{{ $departemen->kode_dept }}" id="kode_dept" name="kode_dept" class="form-control" placeholder="Kode Status Pendidik">
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
        <input type="text" value="{{ $departemen->nama_dept }}" id="nama_dept" name="nama_dept" class="form-control" placeholder="Status Pendidik" autocomplete="off">
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
        Update
        </button>
      </div>
    </div>
  </div>

</form>