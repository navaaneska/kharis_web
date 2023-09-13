@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Media</h1>
            <a href="{{ route('events-media.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Create Media</a>
        </div>

        <table id="myTable" class="table">
            <thead>
                <tr>
                    <td>dari event</td>
                    <td>judul</td>
                    <td>file</td>
                    <td>jenis</td>
                    <td>utama</td>
                    <td>
                        actions
                    </td>
                </tr>

            </thead>
            <tbody>
                @foreach ($medias as $media)
                    <tr>
                        <td>{{ $media->event->nama }}</td>
                        <td>{{ substr($media->judul, 0, 10) }}</td>
                        <td>{{ substr($media->file, 0, 10) }}</td>
                        <td>{{ $media->jenis }}</td>
                        <td>{{ $media->utama }}</td>
                        <td>@include('event_media.actions')</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
