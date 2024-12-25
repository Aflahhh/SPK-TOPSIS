@extends('admin.layout.main')

@section('content')
    {{-- Toast Notification --}}
    @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('berhasil'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('berhasil') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('selesai'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('selesai') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif  

    <div class="card rounded-4" style="height: 90px" >
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;" >Data Kriteria</h5>
                <div class="d-flex ">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-info rounded-5 ms-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah
                    </button>
                </div>
            </div>
        </div>  
    </div>

    <div class="card rounded-4" >
        <div class="card-body mt-3">    
            <div style="overflow-x:auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th><b>NO</b></th>
                            <th>Kode</th>
                            <th>Kriteria Penilaian</th>
                            <th>Atribut</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($kriteria as $data)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $data->kode_kriteria }}</td>
                                <td>{{ $data->nama_kriteria }}</td>
                                <td>{{ $data->atribut }}</td>
                                <td>{{ $data->bobot }}</td>
                                <td>
                                    <!-- Button Edit -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $data->id }}"> 
                                        <i class="bi bi-pencil"></i> 
                                    </button>
    
                                    <!-- Button Hapus -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                                            data-bs-target="#hapusModal{{ $data->id }}"> 
                                        <i class="bi bi-trash"></i> 
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @include('admin.kinerja.kriteria.tambah')
                    {{-- @include('admin.kinerja.kriteria.edit')
                    @include('admin.kinerja.kriteria.hapus') --}}
                </table>
            </div>
        </div>
    </div>

    {{-- Header Card --}}
    {{-- <div class="card rounded-4" style="height: 90px">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data Kriteria Penilaian</h5>
                <div class="d-flex">
                    <!-- Tambah Button -->
                    <button type="button" class="btn btn-info rounded-5 ms-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah
                    </button>
                </div>
            </div>
        </div>  
    </div> --}}
    
    {{-- Table --}}
    {{-- <div class="card rounded-4">
        <div class="card-body mt-3">    
            <div style="overflow-x:auto;">
                <table class="table table-striped">
                    
                </table>
            </div>
        </div>
    </div> --}}
    
    {{-- Modals for Edit and Delete --}}
    {{-- @foreach ($kriteria as $data)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('kriteria.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="{{ $data->nama_kriteria }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot</label>
                                <input type="number" step="0.01" class="form-control" id="bobot" name="bobot" value="{{ $data->bobot }}" required>
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

        <!-- Delete Modal -->
        <div class="modal fade" id="hapusModal{{ $data->id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('kriteria.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Hapus Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus kriteria ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach --}}

@endsection
