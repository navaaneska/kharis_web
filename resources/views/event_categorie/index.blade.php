@extends('layouts.main')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
            <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
            <a href="{{ route('events-categorie.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Create Kategori</a>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <td>Nama Kategori</td>
                        <td>Icon</td>
                        <td>Image</td>
                        <td>actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                        <tr>
                            <td>{{ $categorie->nama }}</td>
                            @if (File::exists('storage/files/event-categorie/' . $categorie->icon))
                                <td><img src="{{ asset('storage/files/event-categorie/' . $categorie->icon) }}"
                                        style="width:80px">
                                </td>
                            @else
                                <td>{{ $categorie->icon }}</td>
                            @endif
                            @if (File::exists('storage/files/event-categorie/' . $categorie->image))
                                <td><img src="{{ asset('storage/files/event-categorie/' . $categorie->image) }}"
                                        style="width:80px">
                                </td>
                            @else
                                <td>{{ $categorie->image }}</td>
                            @endif
                            <td>@include('event_categorie.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
