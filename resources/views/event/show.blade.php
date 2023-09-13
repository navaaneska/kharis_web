@extends('layouts.main')

@section('container')
    {{-- <div class="container-sm"> --}}
    <div class="container-sm my-5" style="width: 60%">
        <div class="mb-3 text-center">
            <i class="bi-person-circle fs-1"></i>
            <h4>Detail Employee</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Nama Events</label>
                <h5>{{ $event->nama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Events</label>
                <h5>{{ $event->deskripsi }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Events</label>
                <h5>{{ $event->tanggal_mulai }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai Events</label>
                <h5>{{ $event->tanggal_selesai }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lat" class="form-label">latitude</label>
                <h5>{{ $event->lat }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lng" class="form-label">longitude</label>
                <h5>{{ $event->lng }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ketentuan" class="form-label">Ketentuan Events</label>
                <h5>{{ $event->ketentuan }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Status Events</label>
                <h5>{{ $event->status }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Maksimal Peserta</label>
                <h5>{{ $event->maksimal_peserta }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Harga</label>
                <h5>Rp.{{ $event->harga }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-grid">
                <a href="{{ route('events.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
                        class="bi-arrow-left-circle me-2"></i> Back</a>
            </div>
        </div>


        {{-- </div> --}}
    @endsection
