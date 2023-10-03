@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class=" align-items-center text-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Persensi {{ $qrCode->judul }}</h1>
            <h1 class="h3 mb-0 text-gray-800">Event {{ $qrCode->event->nama }}</h1>
        </div>

        <div class="text-center">{!! QrCode::size(300)->generate($qrCode->qr) !!}</div>


        <table id="myTable" class="table">
            <thead>
                <tr>
                    <td>Peserta</td>
                    <td>waktu presensi</td>
                </tr>

            </thead>
            <tbody>
                @foreach ($pesertaPresensis as $pesertaPresensi)
                    <tr>
                        <td>{{ $pesertaPresensi->user->username }}</td>
                        <td>{{ $pesertaPresensi->jam_presensi }}</td>
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
