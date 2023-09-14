@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Events</h1>
            <a href="{{ route('events.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Create Event</a>
        </div>

        <table id="myTable" class="table">
            <thead>
                <tr>
                    <td>nama</td>
                    <td>deskripsi</td>
                    <td>ketentuan</td>
                    <td>status</td>
                    <td>harga</td>
                    <td>maksimal peserta</td>
                    <td>
                        actions
                    </td>
                </tr>

            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ substr($event->nama, 0, 10) }}</td>
                        <td>{{ substr($event->deskripsi, 0, 10) }}</td>
                        <td>{{ $event->ketentuan }}</td>
                        <td>{{ $event->status }}</td>
                        <td>{{ $event->harga }}</td>
                        <td>{{ $event->maksimal_peserta }}</td>
                        <td>@include('event.actions')</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <iframe src="https://www.youtube.com/embed/QPCX24ToLHs?si=0ziJFwd_9rfyzN9k" frameborder="0"></iframe>
    <iframe style="border-radius:12px"
        src="https://open.spotify.com/embed/track/0qjuyXWrksQxIRntqz9ZJV?utm_source=generator" width="100%" height="352"
        frameBorder="0" allowfullscreen=""
        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe> --}}


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
