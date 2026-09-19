@extends('layout')

@section('content')
<h3>Data Tugas Terkumpul</h3>

<!-- Form Pencarian -->
<form action="{{ route('tampil.tugas') }}" method="GET" class="mb-3 d-flex gap-2">
    <input type="text" name="search" class="form-control w-25" placeholder="Cari Nama, NIM, File..." value="{{ $search ?? '' }}">
    <button type="submit" class="btn btn-primary">Cari</button>
    <a href="{{ route('tampil.tugas') }}" class="btn btn-secondary">Reset</a>
</form>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nama File</th>
            <th>Tanggal Kumpul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tugas as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->nim }}</td>
            <td>{{ $item->nama_file }}</td>
            <td>{{ \Carbon\Carbon::parse($item->waktu_kumpul ?? $item->created_at)->format('d-m-Y') }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('lihat.tugas', $item->id) }}" target="_blank" class="btn btn-sm btn-info text-white">Lihat PDF</a>
                    <a href="{{ route('edit.tugas', $item->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>

                    <form action="{{ route('hapus.tugas', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini? File PDF juga akan dihapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data tugas yang dikumpulkan.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection