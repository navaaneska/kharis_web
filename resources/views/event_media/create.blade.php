@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <div class="mt-5">
            <form action="{{ route('events-media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="p-5 bg-light rounded-3 border col-xl-10">

                        <div class="mb-3 text-center">
                            <i class="bi-person-circle fs-1"></i>
                            <h4>Create Media Events</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">Nama Events</label>
                                <select name="nama" id="nama" class="form-select">
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}" {{ old('nama') == $event ? 'selected' : '' }}>
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
                                    name="judul" id="judul" value="{{ old('judul') }}"
                                    placeholder="Masukkan judul media" />
                                @error('judul')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="file" class="form-label">file</label>
                                <input class="form-control  @error('file') is-invalid @enderror" type="file"
                                    name="file" id="file" placeholder="Masukkan file media" />
                                @error('file')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jenis" class="form-label">jenis</label>
                                <select name="jenis" id="jenis" class="form-select">
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie }}"
                                            {{ old('categorie') == $categorie ? 'selected' : '' }}>
                                            {{ $categorie }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi" class="form-label">deskripsi</label>
                                <textarea class="form-control  @error('deskripsi') is-invalid @enderror" type="deskripsi" name="deskripsi"
                                    id="deskripsi" placeholder="Masukkan deskripsi media"></textarea>
                                @error('deskripsi')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="utama" class="form-label">Utama</label>
                                <select name="utama" id="utama" class="form-select">
                                    @foreach ($utamas as $utama)
                                        <option value="{{ $utama }}"
                                            {{ old('utama') == $utama ? 'selected' : '' }}>
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
                                <a href="{{ route('events-media.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
                                        class="bi-arrow-left-circle me-2"></i> Cancel</a>
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
