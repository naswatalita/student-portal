@extends('layout')

@section('content')
<h3>Data Absen Masuk</h3>

<!-- Form Pencarian -->
<form action="{{ route('tampil.absen') }}" method="GET" class="mb-3 d-flex gap-2">
    <input type="text" name="search" class="form-control w-25" placeholder="Cari Nama atau NIM..." value="{{ $search ?? '' }}">
    <button type="submit" class="btn btn-primary">Cari</button>
    <a href="{{ route('tampil.absen') }}" class="btn btn-secondary">Reset</a>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($absen as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->nim }}</td>
            <td>
                <form action="{{ route('hapus.absen', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Belum ada data absen.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection