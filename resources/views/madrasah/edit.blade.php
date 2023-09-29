<form action="/madrasah/update" method="POST" id="frmMadrasahEdit" >
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
        <input type="text" readonly value="{{ $madrasah->kode_madrasah }}" id="kode_madrasah" name="kode_madrasah" class="form-control" placeholder="12 Digit NSM Madrasah" autocomplete="off">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="input-icon mb-3">
      <span class="input-icon-addon">
        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M3 21l18 0"></path>
          <path d="M9 8l1 0"></path>
          <path d="M9 12l1 0"></path>
          <path d="M9 16l1 0"></path>
          <path d="M14 8l1 0"></path>
          <path d="M14 12l1 0"></path>
          <path d="M14 16l1 0"></path>
          <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
        </svg>
      </span>
        <input type="text" value="{{ $madrasah->nama_madrasah }}" id="nama_madrasah" name="nama_madrasah" class="form-control" placeholder="Nama Madrasah" autocomplete="off">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="input-icon mb-3">
      <span class="input-icon-addon">
        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-pentagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M13.163 2.168l8.021 5.828c.694 .504 .984 1.397 .719 2.212l-3.064 9.43a1.978 1.978 0 0 1 -1.881 1.367h-9.916a1.978 1.978 0 0 1 -1.881 -1.367l-3.064 -9.43a1.978 1.978 0 0 1 .719 -2.212l8.021 -5.828a1.978 1.978 0 0 1 2.326 0z"></path>
          <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z"></path>
          <path d="M6 20.703v-.703a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.707"></path>
        </svg>
      </span>
        <input type="text" value="{{ $madrasah->nama_kamad }}" id="nama_kamad" name="nama_kamad" class="form-control" placeholder="Nama Kepala Madrasah" autocomplete="off">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="input-icon mb-3">
      <span class="input-icon-addon">
        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z"></path>
          <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741"></path>
          <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z"></path>
        </svg>
      </span>
        <input type="text" value="{{ $madrasah->nama_kaur_tu }}" id="nama_kaur_tu" name="nama_kaur_tu" class="form-control" placeholder="Nama Kepala Tata Usaha" autocomplete="off">
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
        <input type="text" value="{{ $madrasah->lokasi_madrasah }}" id="lokasi_madrasah" name="lokasi_madrasah" class="form-control" placeholder="Lokasi Latitude dan Longitude Madrasah" autocomplete="off">
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
        <input type="text" value="{{ $madrasah->radius_madrasah }}" id="radius_madrasah" name="radius_madrasah" class="form-control" placeholder="Radius diperbolehkan untuk Absen (skala meter)" autocomplete="off">
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

<script>
  $(function() {
    $("#frmMadrasahEdit").submit(function() {
        // ditampung oleh nik
        var kode_madrasah = $("#frmMadrasahEdit").find("#kode_madrasah").val();
        var nama_madrasah = $("#frmMadrasahEdit").find("#nama_madrasah").val();
        var lokasi_madrasah = $("#frmMadrasahEdit").find("#lokasi_madrasah").val();
        var radius_madrasah = $("#frmMadrasahEdit").find("#radius_madrasah").val();        

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