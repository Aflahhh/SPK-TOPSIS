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
                        <th>Kriteria</th>
                        <th>Sub Kriteria</th>
                        <th>Fungsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subKriteria as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kriteria->nama_kriteria }}</td>
                            <td>{{ $item->nama_subkriteria }}</td>
                            <td>{{ ucfirst($item->fungsi) }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>
                                <!-- Delete Form -->
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('subkriteria.tambah') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Sub Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kriteria_id" class="form-label">Pilih Kriteria</label>
                        <select name="kriteria_id" id="kriteria_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kriteria --</option>
                            @foreach ($kriteria as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kriteria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_subkriteria" class="form-label">Nama Sub Kriteria</label>
                        <input type="text" class="form-control" id="nama_subkriteria" name="nama_subkriteria" required>
                    </div>
                    <div class="mb-3">
                        <label for="fungsi" class="form-label">Fungsi</label>
                        <select name="fungsi" id="fungsi" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Fungsi --</option>
                            <option value="cost">Cost</option>
                            <option value="benefit">Benefit</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Include modals for edit dynamically -->
@foreach ($subKriteria as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('subkriteria.edit', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Sub Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kriteria_id_{{ $item->id }}" class="form-label">Pilih Kriteria</label>
                        <select name="kriteria_id" id="kriteria_id_{{ $item->id }}" class="form-select" required>
                            @foreach ($kriteria as $k)
                                <option value="{{ $k->id }}" {{ $k->id == $item->kriteria_id ? 'selected' : '' }}>
                                    {{ $k->nama_kriteria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_subkriteria_{{ $item->id }}" class="form-label">Nama Sub Kriteria</label>
                        <input type="text" class="form-control" id="nama_subkriteria_{{ $item->id }}" name="nama_subkriteria" value="{{ $item->nama_subkriteria }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="fungsi_{{ $item->id }}" class="form-label">Fungsi</label>
                        <select name="fungsi" id="fungsi_{{ $item->id }}" class="form-select" required>
                            <option value="cost" {{ $item->fungsi == 'cost' ? 'selected' : '' }}>Cost</option>
                            <option value="benefit" {{ $item->fungsi == 'benefit' ? 'selected' : '' }}>Benefit</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection
