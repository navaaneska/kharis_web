@extends('layouts.main')

@section('container')
    {{-- <div class="container-sm"> --}}
    <div class="container-sm my-5" style="width: 60%">
        <div class="mb-3 text-center">
            <i class="bi-person-circle fs-1"></i>
            <h4>Detail Event Media</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Nama Events</label>
                <h5>{{ $eventMedia->event->nama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="deskripsi" class="form-label">Judul</label>
                <h5>{{ $eventMedia->judul }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="tanggal_mulai" class="form-label">File Image</label><br />
                @if ($eventMedia->jenis == 'image')
                    <img src="{{ asset('storage/files/event-media/' . $eventMedia->file) }}" alt="{{ $eventMedia->judul }}"
                        style="width:10%">
                @elseif ($eventMedia->jenis == 'youtube')
                    {{-- <iframe src="{{ 'https://www.youtube.com/embed/' . $eventMedia->file }}"
                                    frameborder="0"></iframe> --}}
                    <a href="{{ 'https://www.youtube.com/live/' . $eventMedia->file }}" target="_blank"><img
                            src="{{ $eventMedia->thumbnail }}" style="width: 50%"></a>
                @else
                    <a href="{{ 'https://open.spotify.com/episode/' . $eventMedia->file }}"><img
                            src="{{ $eventMedia->thumbnail }}" style="width: 30%"></a>
                @endif

            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal_selesai" class="form-label">Jenis</label>
                <h5>{{ $eventMedia->jenis }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lat" class="form-label">Utama</label>
                <h5>{{ $eventMedia->utama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="tanggal_selesai" class="form-label">deskripsi</label>
                <h5>{{ $eventMedia->deskripsi }}</h5>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12 d-grid">
                <a href="{{ route('events.show', ['event' => $eventMedia->event_id]) }}"
                    class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Back</a>
            </div>
        </div>


        {{-- </div> --}}
    @endsection
