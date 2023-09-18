@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <div class="mt-5">
            <form action="{{ route('events-categorie.update', ['events_categorie' => $kategori->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row justify-content-center">
                    <div class="p-5 bg-light rounded-3 border col-xl-10">

                        <div class="mb-3 text-center">
                            <i class="bi-person-circle fs-1"></i>
                            <h4>Edit Categories</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">nama</label>
                                <input class="form-control  @error('nama') is-invalid @enderror" type="text"
                                    name="nama" id="nama" value="{{ $kategori->nama }}"
                                    placeholder="Masukkan nama media" />
                                @error('nama')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="icon" class="form-label">icon</label>
                                <input class="form-control  @error('icon') is-invalid @enderror" type="file"
                                    name="icon" id="icon" placeholder="Masukkan icon media" />
                                @error('icon')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label">image</label>
                                <input class="form-control  @error('image') is-invalid @enderror" type="file"
                                    name="image" id="image" placeholder="Masukkan image media" />
                                @error('image')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 d-grid">
                                    <a href="{{ route('events-categorie.index') }}"
                                        class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i>
                                        Cancel</a>
                                </div>
                                <div class="col-md-6 d-grid">
                                    <button type="submit" class="btn btn-dark btn-lg mt-3"><i
                                            class="bi-check-circle me-2"></i>
                                        Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
