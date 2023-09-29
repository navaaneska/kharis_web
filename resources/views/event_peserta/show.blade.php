@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Peserta</h1>
        </div>

        <table id="myTable" class="table">
            <thead>
                <tr>
                    <td>No.</td>
                    <td>Nama Peserta</td>
                    <td>Email</td>
                    <td>No Hp</td>
                    <td>Alamat</td>
                </tr>

            </thead>
            <tbody>
                @foreach ($participants as $key => $participant)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $participant->user->name }}</td>
                        <td>{{ $participant->user->email }}</td>
                        <td>{{ $participant->user->whatsapp }}</td>
                        <td>{{ $participant->user->alamat }}</td>
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
