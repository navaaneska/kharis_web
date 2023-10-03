@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <div class="mt-5">
            <form action="{{ route('events-qrcode.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="p-5 bg-light rounded-3 border col-xl-10">

                        <div class="mb-3 text-center">
                            <i class="bi-person-circle fs-1"></i>
                            <h4>Create Presensi</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">Nama Events</label>
                                <h6>{{ $event->nama }}</h6>
                                <input type="text" name="nama" id="nama" value="{{ $event->id }}"
                                    style="display: none">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">judul</label>
                                <input class="form-control  @error('judul') is-invalid @enderror" type="text"
                                    name="judul" id="judul" value="{{ old('judul') }}"
                                    placeholder="Masukkan judul presensi" />
                                @error('judul')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 d-grid">
                                <a href="{{ route('events-qrcode.show', ['events_qrcode' => $event->id]) }}"
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
