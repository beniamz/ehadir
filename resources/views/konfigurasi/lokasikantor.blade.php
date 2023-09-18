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
          Konfigurasi Lokasi Kantor
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">

  <div class="container-xl">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">

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


            <form action="/konfigurasi/updatelokasikantor" method="POST">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7"></path>
                        <path d="M9 4v13"></path>
                        <path d="M15 7v5"></path>
                        <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                        <path d="M19 18v.01"></path>
                      </svg>
                    </span>
                    <input type="text" value="{{ $tilok->lokasi_kantor }}" id="lokasi_kantor" name="lokasi_kantor" class="form-control" placeholder="Titik Lokasi Kantor">
                  </div>

                  <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-flightradar24" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                        <path d="M8.5 20l3.5 -8l-6.5 6"></path>
                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                      </svg>
                    </span>
                    <input type="text" value="{{ $tilok->radius }}" id="radius" name="radius" class="form-control" placeholder="Jarak diperbolehkan Absen">
                  </div>

                  <div class="row mt-3">
                    <div class="col-12">
                      <div class="form-group">
                        <button class="btn btn-primary w-100"> 
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google-maps" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                            <path d="M6.428 12.494l7.314 -9.252"></path>
                            <path d="M10.002 7.935l-2.937 -2.545"></path>
                            <path d="M17.693 6.593l-8.336 9.979"></path>
                            <path d="M17.591 6.376c.472 .907 .715 1.914 .709 2.935a7.263 7.263 0 0 1 -.72 3.18a19.085 19.085 0 0 1 -2.089 3c-.784 .933 -1.49 1.93 -2.11 2.98c-.314 .62 -.568 1.27 -.757 1.938c-.121 .36 -.277 .591 -.622 .591c-.315 0 -.463 -.136 -.626 -.593a10.595 10.595 0 0 0 -.779 -1.978a18.18 18.18 0 0 0 -1.423 -2.091c-.877 -1.184 -2.179 -2.535 -2.853 -4.071a7.077 7.077 0 0 1 -.621 -2.967a6.226 6.226 0 0 1 1.476 -4.055a6.25 6.25 0 0 1 4.811 -2.245a6.462 6.462 0 0 1 1.918 .284a6.255 6.255 0 0 1 3.686 3.092z"></path>
                          </svg>
                          Update
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection