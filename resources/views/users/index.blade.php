@extends('layouts.template')

@section('content')
<div class="container border py-4 rounded">
    <div id="msg-success"></div>

@if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
@endif
@if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
@endif

<h2>Data User</h2>
   
<div style="margin-bottom: 15px; justify-content: flex-end; display: flex;">
    <a class="btn btn-primary" href="{{ route('user.create') }}">Tambah Data</a>
</div>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($users as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['role'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-3"><i class="bi bi-pencil-square">Edit</i></a>
                                <form action="{{ route('user.delete', $item['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
               
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection