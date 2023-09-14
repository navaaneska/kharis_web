@extends('layouts.main')

@section('container')
    <div class="container-sm my-5" style="width: 60%">
        <div class="mb-3 text-center">
            <i class="bi-person-circle fs-1"></i>
            <h4>Detail Event Media</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <h5>{{ $kategori->nama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="deskripsi" class="form-label">Icon</label><br>

                @if (File::exists('storage/files/event-categorie/' . $kategori->icon))
                    <img src="{{ asset('storage/files/event-categorie/' . $kategori->icon) }}" style="width:10%">
                @else
                    <h5>{{ $kategori->icon }}</h5>
                @endif
            </div>
            <div class="col-md-12 mb-3">
                <label for="deskripsi" class="form-label">Image</label><br>

                @if (File::exists('storage/files/event-categorie/' . $kategori->image))
                    <img src="{{ asset('storage/files/event-categorie/' . $kategori->image) }}" style="width:10%">
                @else
                    <h5>{{ $kategori->image }}</h5>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-grid">
                <a href="{{ route('events-categorie.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
                        class="bi-arrow-left-circle me-2"></i> Back</a>
            </div>
        </div>
    @endsection
