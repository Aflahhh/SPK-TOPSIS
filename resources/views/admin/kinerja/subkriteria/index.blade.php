@extends('admin.layout.main')

@section('content')

<div class="card rounded-4" style="height: 90px">
    <div class="card-body mt-2">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title" style="font-size: 24px;">Data Sub Kriteria</h5>
            <div class="d-flex">
                <!-- Plus Button -->
                <button type="button" class="btn btn-info rounded-5 ms-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah
                </button>
            </div>
        </div>
    </div>  
</div>

<div class="card rounded-4">
    <div class="card-body mt-3">    
        <div style="overflow-x:auto;">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Sub Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subKriteria as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kriteria->kode_kriteria }}</td>
                            <td>{{ $item->nama_subkriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <a href="{{ route('subkriteria.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('subkriteria.hapus', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include modal outside of the loop -->
@include('admin.kinerja.subkriteria.tambah')

@endsection
