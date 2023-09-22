@extends('layouts.main')

@section('container')
    <div class="mt-5">
        <form action="{{ route('events.update', ['event' => $event->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row justify-content-center" style="width: 100%">
                <div class="p-5 bg-light rounded-3 border col-xl-10">

                    <div class="mb-3 text-center">
                        <i class="bi-person-circle fs-1"></i>
                        <h4>Edit Employee</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama" class="form-label">Nama Events</label>
                            <input class="form-control  @error('nama') is-invalid @enderror" type="text" name="nama"
                                id="nama" value="{{ $event->nama }}" placeholder="Masukkan Nama Event">
                            @error('nama')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control  @error('deskripsi') is-invalid @enderror" type="text" name="deskripsi" id="deskripsi"
                                value="{{ old('deskripsi') }}" placeholder="Masukkan Deskripsi Event">{{ $event->deskripsi }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input class="form-control  @error('tanggal_mulai') is-invalid @enderror" type="datetime-local"
                                name="tanggal_mulai" id="tanggal_mulai" value="{{ $event->tanggal_mulai }}"
                                placeholder="Masukkan Deskripsi Event">
                            @error('tanggal_mulai')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input class="form-control  @error('tanggal_selesai') is-invalid @enderror"
                                type="datetime-local" name="tanggal_selesai" id="tanggal_selesai"
                                value="{{ $event->tanggal_selesai }}" placeholder="Masukkan Deskripsi Event">
                            @error('tanggal_selesai')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="featured_image" class="form-label">Image</label>
                            <input class="form-control  @error('featured_image') is-invalid @enderror" type="file"
                                name="featured_image" id="featured_image" value="{{ old('featured_image') }}"
                                placeholder="Masukkan Deskripsi Event">
                            @error('featured_image')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <h6>Lokasi :</h6>
                        </div>
                        <hr>
                        <div class="col-md-12 mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input class="form-control  @error('lokasi') is-invalid @enderror" type="text" name="lokasi"
                                id="lokasi" value="{{ $event->lokasi }}" placeholder="Enter Last Name">
                            @error('lokasi')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lat" class="form-label">Latitude</label>
                            <input class="form-control  @error('lat') is-invalid @enderror" type="text" name="lat"
                                id="lat" value="{{ $event->lat }}" placeholder="Enter Last Name">
                            @error('lat')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lng" class="form-label">Longitude</label>
                            <input class="form-control  @error('lng') is-invalid @enderror" type="text" name="lng"
                                id="lng" value="{{ $event->lng }}" placeholder="Enter lng">
                            @error('lng')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="ketentuan" class="form-label">Ketentuan</label>
                            <textarea class="form-control  @error('ketentuan') is-invalid @enderror" type="text" name="ketentuan" id="ketentuan"
                                value="{{ $event->ketentuan }}" placeholder="Masukan Ketentuan">{{ $event->ketentuan }}</textarea>
                            @error('ketentuan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">status</label>
                            <select name="status" id="status" class="form-select">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}"
                                        {{ $event->status == $status ? 'selected' : '' }}>
                                        {{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="online" class="form-label">online</label>
                            <select name="online" id="online" class="form-select">
                                @foreach ($onlines as $online)
                                    <option value="{{ $online }}" {{ $getOnline == $online ? 'selected' : '' }}>
                                        {{ $online }}</option>
                                @endforeach
                            </select>
                            @error('utama')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input class="form-control  @error('harga') is-invalid @enderror" type="number"
                                name="harga" id="harga" value="{{ $event->harga }}"
                                placeholder="Enter Last Name">
                            @error('harga')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="maksimal_peserta" class="form-label">Peserta</label>
                            <input class="form-control  @error('maksimal_peserta') is-invalid @enderror" type="number"
                                name="maksimal_peserta" id="maksimal_peserta" value="{{ $event->maksimal_peserta }}"
                                placeholder="Maksimal Peserta">
                            @error('maksimal_peserta')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="kategori_id" class="form-label">Kategori Satu</label>
                            <select name="kategori_id" id="kategori_id" class="form-select">
                                @foreach ($categories as $categori)
                                    <option value="{{ $categori->id }}"
                                        {{ $event->kategori_id == $categori->id ? 'selected' : '' }}>
                                        {{ $categori->nama }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="kategori2_id" class="form-label">Kategori Dua</label>
                            <select name="kategori2_id" id="kategori2_id" class="form-select">
                                <option value=0>-</option>
                                @foreach ($categories as $categori)
                                    <option value="{{ $categori->id }}"
                                        {{ $event->kategori2_id == $categori->id ? 'selected' : '' }}>
                                        {{ $categori->nama }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="kategori3_id" class="form-label">Kategori Tiga</label>
                            <select name="kategori3_id" id="kategori3_id" class="form-select">
                                <option value=0>-</option>
                                @foreach ($categories as $categori)
                                    <option value="{{ $categori->id }}"
                                        {{ $event->kategori3_id == $categori->id ? 'selected' : '' }}>
                                        {{ $categori->nama }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('events.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
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


    <script>
        $('#deskripsi').summernote({
            placeholder: 'masukkan deskripsi',
            tabsize: 2,
            height: 100
        });
        $('#ketentuan').summernote({
            placeholder: 'masukkan ketentuan',
            tabsize: 2,
            height: 100
        });
    </script>
@endsection
