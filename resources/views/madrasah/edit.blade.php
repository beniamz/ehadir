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
        <input type="text" readonly value="{{ $madrasah->kode_madrasah }}" id="kode_madrasah" name="kode_madrasah" class="form-control" placeholder="Tanda petik (') + 3 Digit terakhit NSM Madrasah">
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
        <input type="text" value="{{ $madrasah->nama_madrasah }}" id="nama_madrasah" name="nama_madrasah" class="form-control" placeholder="Nama Madrasah">
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
        <input type="text" value="{{ $madrasah->lokasi_madrasah }}" id="lokasi_madrasah" name="lokasi_madrasah" class="form-control" placeholder="Lokasi Latitude dan Longitude Madrasah">
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
        <input type="text" value="{{ $madrasah->radius_madrasah }}" id="radius_madrasah" name="radius_madrasah" class="form-control" placeholder="Radius diperbolehkan untuk Absen (skala meter)">
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