@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <div class="mt-5">
            <form action="{{ route('events-media.update', ['events_medium' => $eventMedia->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row justify-content-center">
                    <div class="p-5 bg-light rounded-3 border col-xl-10">

                        <div class="mb-3 text-center">
                            <i class="bi-person-circle fs-1"></i>
                            <h4>Edit Media Events</h4>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">Nama Events</label>
                                <select name="nama" id="nama" class="form-select">
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}"
                                            {{ $event->id == $eventMedia->event_id ? 'selected' : '' }}>
                                            {{ $event->nama }}</option>
                                    @endforeach
                                </select>
                                @error('nama')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">judul</label>
                                <input class="form-control  @error('judul') is-invalid @enderror" type="text"
                                    name="judul" id="judul" value="{{ $eventMedia->judul }}"
                                    placeholder="Masukkan judul media" />
                                @error('judul')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jenis" class="form-label">jenis</label>
                                <select name="jenis" id="jenis" class="form-select">
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie }}"
                                            {{ $eventMedia->jenis == $categorie ? 'selected' : '' }}>
                                            {{ $categorie }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <hr>
                            <h6>jika memilih jenis image masukkan gambar</h6>
                            <div class="col-md-12 mb-3">
                                <label for="file" class="form-label">file</label>
                                <input class="form-control  @error('file') is-invalid @enderror" type="file"
                                    name="file" id="file" placeholder="Masukkan file media" />
                                @error('file')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <hr>
                            <h6>jika memilih jenis spotify dan youtube masukkan link</h6>
                            <div class="col-md-12 mb-3">
                                <label for="link" class="form-label">link</label>
                                <input class="form-control  @error('link') is-invalid @enderror" type="text"
                                    name="link" id="link"
                                    value="@if ($eventMedia->jenis == 'youtube') {{ 'https://youtu.be/' . $eventMedia->file }}
                                    @elseif ($eventMedia->jenis == 'spotify') {{ 'https://open.spotify.com/episode/' . $eventMedia->file }} @endif"
                                    placeholder="Masukkan link spotify atau youtube" />
                                @error('link')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <hr>
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">deskripsi</label>
                                <input class="form-control  @error('deskripsi') is-invalid @enderror" type="text"
                                    name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi media"
                                    value="{{ $eventMedia->deskripsi }}" />
                                @error('deskripsi')
                                    <div class="text-danger"><small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="utama" class="form-label">Utama</label>
                                <select name="utama" id="utama" class="form-select">
                                    @foreach ($utamas as $utama)
                                        <option value="{{ $utama }}" {{ $getUtama == $utama ? 'selected' : '' }}>
                                            {{ $utama }}</option>
                                    @endforeach
                                </select>
                                @error('utama')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 d-grid">
                                <a href="{{ route('events.show', ['event' => $eventMedia->event_id]) }}"
                                    class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i>
                                    Cancel</a>
                            </div>
                            <div class="col-md-6 d-grid">
                                <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
