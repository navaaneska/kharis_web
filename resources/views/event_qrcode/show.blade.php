@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar List Persensi {{ $event->nama }}</h1>
            <a href="{{ route('events-qrcode.createNew', ['id' => $event->id]) }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Create Presensi</a>
        </div>


        <table id="myTable" class="table">
            <thead>
                <tr>
                    <td>QR Codes</td>
                    <td>Judul</td>
                    <td>actions</td>
                </tr>

            </thead>
            <tbody>
                @foreach ($eventQrCodes as $eventQrCode)
                    <tr>
                        <td>{!! QrCode::size(200)->generate($eventQrCode->qr) !!}</td>
                        <td>{{ $eventQrCode->judul }}</td>
                        <td>@include('event_qrcode.actions')</td>
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
