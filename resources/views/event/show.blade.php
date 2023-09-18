@extends('layouts.main')

@section('container')
    {{-- <div class="container-sm"> --}}
    <div class="container-sm my-5" style="width: 60%">
        <div class="mb-3 text-center">
            <i class="bi-person-circle fs-1"></i>
            <h4>Detail Event</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Nama Events</label>
                <h5>{{ $event->nama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Events</label>
                <div>{!! $event->deskripsi !!}</div>
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

            <div> List Media</div>
            @foreach ($medias as $media)
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            @if ($media->jenis == 'image')
                                <img src="{{ asset('storage/files/event-media/' . $media->file) }}"
                                    alt="{{ $media->judul }}" style="width:50%">
                            @elseif ($media->jenis == 'youtube')
                                {{-- <iframe src="{{ 'https://www.youtube.com/embed/' . $media->file }}"
                                        frameborder="0"></iframe> --}}
                                <a href="{{ 'https://www.youtube.com/live/' . $media->file }}" target="_blank"><img
                                        src="{{ $media->thumbnail }}" style="width: 100%"></a>
                            @else
                                <img src="{{ $media->thumbnail }}" alt="" srcset="">
                                {{-- <iframe src="{{ 'https://open.spotify.com/embed/track/' . $media->file }}"
                                    frameborder="0"></iframe> --}}
                            @endif
                        </div>
                        <div class="col-md-6">
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
