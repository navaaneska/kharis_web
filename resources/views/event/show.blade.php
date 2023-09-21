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
            <div class="col-sm-3 mb-1">
                <label for="nama" class="form-label font-weight-bold">Nama Events</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->nama }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="deskripsi" class="form-label font-weight-bold">Deskripsi Events</label>
            </div>
            <div class="col-sm-9 mb-1">
                <div>{!! $event->deskripsi !!}</div>
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
            <div class="col-sm-3 mb-1">
                <label for="lng" class="form-label font-weight-bold">longitude</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->lng }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="ketentuan" class="form-label font-weight-bold">Ketentuan Events</label>
            </div>
            
            <div class="col-sm-9 mb-1">
                {{ $event->ketentuan }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="nama" class="form-label font-weight-bold">Status Events</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->status }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="nama" class="form-label font-weight-bold">Maksimal Peserta</label>
            </div>
            <div class="col-sm-9 mb-1">
                {{ $event->maksimal_peserta }}
            </div>
            <div class="col-sm-3 mb-1">
                <label for="nama" class="form-label font-weight-bold">Harga</label>
            </div>
            <div class="col-sm-9 mb-1">
                <p>Rp.{{ $event->harga }}
            </div>

            <hr/>
            <div class="row mb-1"> 
                <div class="col-md-6"> 
                    <a href="{{ route('events-media.createNew', ['id' => $event->id]) }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa fa-plus"></i> Create Media</a>
                </div>
                <br/>
            </div>
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
