@extends('layouts.main')

@section('container')
    {{-- <div class="container-sm"> --}}
    <div class="container-sm my-5" style="width: 60%">
        <div class="mb-1 text-center">
            <i class="bi-person-circle fs-1"></i>
            <h4>Detail Event</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Image</label><br>
                <img src="{{ asset('storage/files/featured-image/' . $event->featured_image) }}" alt="{{ $event->judul }}"
                    style="width:20%">
            </div>
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Nama Events</label>
                <h5>{{ $event->nama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Events</label>
                <h5>{!! $event->deskripsi !!}</h5>
            </div>
            <div class="col-sm-3 mb-1">
                <label for="tanggal_mulai" class="form-label font-weight-bold">Tanggal Mulai</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->tanggal_mulai }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="tanggal_selesai" class="form-label font-weight-bold">Tanggal Selesai</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->tanggal_selesai }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="lat" class="form-label font-weight-bold">latitude</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->lat }}
            </div>
            <div class="col-md-12 mb-3">
                <label for="lat" class="form-label">lokasi</label>
                <h5>{{ $event->lokasi }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lat" class="form-label">latitude</label>
                <h5>{{ $event->lat }}</h5>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->lng }}
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Status Events</label>
                <h5>{{ $event->status }}</h5>
            </div>
            <div class="col-sm-3 mb-1">
                <label for="nama" class="form-label font-weight-bold">Status Events</label>
            </div>
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Harga</label>
                <h5>Rp.{{ $event->harga }}</h5>
            </div>
            <div class="col-md-4 mb-3">
                <label for="nama" class="form-label">Kategori 1</label>
                <h5>{{ $event->event_categorie->nama }}</h5>
            </div>
            <div class="col-md-4 mb-3">
                <label for="nama" class="form-label">Kategori 2</label>
                @if ($event->event_categorie2)
                    <h5>{{ $event->event_categorie2->nama }}</h5>
                @else
                    <h5>-</h5>
                @endif
            </div>
            <div class="col-md-4 mb-3">
                <label for="nama" class="form-label">Kategori3</label>
                @if ($event->event_categorie3)
                    <h5>{{ $event->event_categorie3->nama }}</h5>
                @else
                    <h5>-</h5>
                @endif
            </div>
            <div class="col-md-12 mb-3">
                <label for="ketentuan" class="form-label">Ketentuan Events</label>
                <h5>{!! $event->ketentuan !!}</h5>
            </div>
            <div> List Media</div>
            @foreach ($medias as $media)
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($media->jenis == 'image')
                                <img src="{{ asset('storage/files/event-media/' . $media->file) }}"
                                    alt="{{ $media->judul }}" style="width:50%">
                            @elseif ($media->jenis == 'youtube')
                                {{-- <iframe src="{{ 'https://www.youtube.com/embed/' . $media->file }}"
                                        frameborder="0"></iframe> --}}
                                <a href="{{ 'https://www.youtube.com/live/' . $media->file }}" target="_blank"><img
                                        src="{{ $media->thumbnail }}" style="width: 100%"></a>
                            @else
                                <a href="{{ 'https://open.spotify.com/episode/' . $media->file }}"><img
                                        src="{{ $media->thumbnail }}" style="width: 70%"></a>
                                {{-- <iframe src="{{ 'https://open.spotify.com/embed/track/' . $media->file }}"
                                    frameborder="0"></iframe> --}}
                            @endif
                        </div>
                        <div class="col-md-12 mt-2" >
                            <div class="d-flex">
                                <a href="{{ route('events-media.show', ['events_medium' => $media->id]) }}"
                                    class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                <a href="{{ route('events-media.edit', ['events_medium' => $media->id]) }}"
                                    class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

                                <div>
                                    <form action="{{ route('events-media.destroy', ['events_medium' => $media->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete"
                                            {{-- data-name="{{ $employee->firstname . ' ' . $employee->lastname }}" --}}>
                                            <i class="bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 d-grid">
                <a href="{{ route('events.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
                        class="bi-arrow-left-circle me-2"></i> Back</a>
            </div>
        </div>


        {{-- </div> --}}
    @endsection
