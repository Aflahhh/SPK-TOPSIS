@extends('admin.layout.main')

@section('content')

<div class="card rounded-4" style="height: 90px">
    <div class="card-body mt-2">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title" style="font-size: 24px;">Data Mata Pelajaran</h5>
            <div class="d-flex">
                <!-- Plus Button -->
                <button type="button" class="btn btn-primary rounded-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Data
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
                        <th>Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mapel as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->mapel }}</td>
                            <td>
                                <a href="{{ route('mapel.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('mapel.hapus', $item->id) }}" method="POST" class="d-inline">
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
@include('admin.mapel.tambah')
@include('admin.mapel.hapus')

@endsection
