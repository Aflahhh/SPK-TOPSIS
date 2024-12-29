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
                                <!-- Edit and Delete Buttons -->
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $item->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#hapusModal{{ $item->id }}">
                                            <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal modal-md fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Sub Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subkriteria.tambah') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="kriteria_id" class="col-sm-4 col-form-label">Pilih Kriteria</label>
                        <div class="col-sm-8">
                            <select name="kriteria_id" id="kriteria_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kriteria --</option>
                                @foreach ($kriteria as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_subkriteria" class="col-sm-4 col-form-label">Nama Sub Kriteria</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="nama_subkriteria" name="nama_subkriteria" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fungsi" class="col-sm-4 col-form-label">Fungsi</label>
                        <div class="col-sm-8">
                            <select name="fungsi" id="fungsi" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Fungsi --</option>
                                <option value="cost">Cost</option>
                                <option value="benefit">Benefit</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($subKriteria as $item)
<div class="modal modal-lg fade" id="editModal{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Sub Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subkriteria.edit', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="kriteria_id_{{ $item->id }}" class="col-sm-4 col-form-label">Pilih Kriteria</label>
                        <div class="col-sm-8">
                            <select name="kriteria_id" id="kriteria_id_{{ $item->id }}" class="form-select" required>
                                @foreach ($kriteria as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $item->kriteria_id ? 'selected' : '' }}>
                                        {{ $k->nama_kriteria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_subkriteria_{{ $item->id }}" class="col-sm-4 col-form-label">Nama Sub Kriteria</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="nama_subkriteria_{{ $item->id }}" name="nama_subkriteria" rows="3" required>{{ $item->nama_subkriteria }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fungsi_{{ $item->id }}" class="col-sm-4 col-form-label">Fungsi</label>
                        <div class="col-sm-8">
                            <select name="fungsi" id="fungsi_{{ $item->id }}" class="form-select" required>
                                <option value="cost" {{ $item->fungsi == 'cost' ? 'selected' : '' }}>Cost</option>
                                <option value="benefit" {{ $item->fungsi == 'benefit' ? 'selected' : '' }}>Benefit</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Hapus -->
@foreach ($subKriteria as $item)
<div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel{{ $item->id }}">Hapus Sub Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subkriteria.hapus', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <i>Apakah Anda Yakin Ingin Menghapus Sub Kriteria <b>{{ $item->nama_subkriteria }}</b>?</i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
