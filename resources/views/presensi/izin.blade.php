@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin / Sakit</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
<style>
    .historicontent {
        display:flex;
        right: 40px;
    }
    .datapresensi {
        left: 10px;                        
        right: 10px;                        
    }
    .status {
        position: absolute;
        right: 20px;
        bottom: 40px;
    }
</style>

<div class="row mb-2" style="margin-top:70px">
    <div class="col">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerror }}
        </div>
        @endif
    </div>
</div>
<div class="row ">
    <div class="col">
    @if($dataizin->isEmpty())
        <div class="alert alert-outline-warning">
            <p>Data Belum Ada</p>
        </div>
    @endif
    @foreach($dataizin as $d)
        @php
            if($d->status=="i") {
                $status = "Izin";
            }else if($d->status=="s") {
                $status = "Sakit";
            }else if($d->status=="c") {
                $status = "Cuti";
            }else{
                $status = "Not Found";
            }
        @endphp
    <div class="card mb-1">
        <div class="card-body">
            <div class="historicontent">
                <div class="iconpresensi mr-2">
                    @if($d->status=="i")
                    <ion-icon name="document-outline" style="font-size:48px; color: rgb(21, 95, 207)"></ion-icon>
                    @elseif($d->status=="s")
                    <ion-icon name="medkit-outline" style="font-size:48px; color: rgb(191, 7, 65)"></ion-icon>
                    @else($d->status=="c")
                    <ion-icon name="document-lock-outline" tyle="font-size:48px; color:orange"></ion-icon>

                    @endif
                </div>
                <div class="datapresensi">
                    <h4 style="line-height: 3px;">{{ date("d-m-Y", strtotime($d->tgl_izin_dari)) }} ( {{ $status }} )</h4>
                    <small>{{ date("d-m-Y", strtotime($d->tgl_izin_dari)) }} s/d {{ date("d-m-Y", strtotime($d->tgl_izin_sampai)) }}</small>
                    <p>{{ $d->keterangan }}
                        <br>
                        @if (!empty($d->doc_sid))
                        <span style="color:blue">
                        <ion-icon name="document-attach-outline"></ion-icon></span>
                        Lihat SID
                        @endif
                    </p>
                  
                </div>
                <div class="status">
                    @if($d->status_approved == 0)
                        <span class="badge bg-warning">Pending</span>
                        @elseif($d->status_approved == 1)
                        <span class="badge bg-success">Disetujui</span>
                        @elseif($d->status_approved == 2)
                        <span class="badge bg-danger">Ditolak</span>
                    @endif  
                    <br>
                    <span class="badge bg-primary mt-1" style="line-height: 17px;"><b>  {{ hitunghari($d->tgl_izin_dari,$d->tgl_izin_sampai) }} Hari</b></span>
                </div>
            </div>
        </div>
    </div>
    <!-- <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <b>{{ date("d-m-Y"), strtotime($d->tgl_izin_dari) }}
                            ( {{ $d->status == "s" ? "Sakit" : "Izin" }} )
                        </b><br>
                        <small class="text-muted">{{ $d->keterangan }}</small>
                    </div> 
                    @if($d->status_approved == 0)
                        <span class="badge bg-warning">Waiting</span>
                        @elseif($d->status_approved == 1)
                        <span class="badge bg-success">Approved</span>
                        @elseif($d->status_approved == 2)
                        <span class="badge bg-danger">Decline</span>
                    @endif                   
                </div>
            </div>
        </li>
    </ul> -->
    @endforeach
    </div>
</div>
<!-- // botton awal -->
<!-- <div class="fab-button bottom-right" style="margin-bottom:70px">
    <a href="/presensi/buatizin" class="fab"><ion-icon name="add-outline"></ion-icon></a> 
</div> -->
<!-- // botton awal -->

<!-- // New Botton -->
<div class="fab-button animate bottom-right dropdown" style="margin-bottom:70px">
    <a href="#" class="fab bg-primary" data-toggle="dropdown">
    <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
    </a>
    <div class="dropdown-menu">
        <a href="/izinabsen" class="dropdown-item bg-primary">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="image outline"></ion-icon>
            <p>Izin Absen</p>
        </a>

        <a href="/izinsakit" class="dropdown-item bg-primary">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="videocam outline"></ion-icon>
            <p>Sakit</p>
        </a>

        <a href="/izincuti" class="dropdown-item bg-primary">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="videocam outline"></ion-icon>
            <p>Cuti</p>
        </a>
    </div>
</div>

@endsection



