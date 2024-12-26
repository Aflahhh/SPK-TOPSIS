@extends('admin.layout.main')

@section('content')
    {{-- Toast --}}
    @if (session()->has('added'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('updated'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Diupdate
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data Berhasil Dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- End Toast --}}

    <div class="card rounded-4" style="height: 90px">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data Status Jabatan</h5>
                <div class="d-flex">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-primary rounded-3 ms-2" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                        Tambah Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Data --}}
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data Status Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('status_jabatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row mb-3 align-items-center">
                                <div class="col-4">
                                    <label for="status_jabatan" class="col-form-label text-nowrap">Status Jabatan</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="status_jabatan" name="status_jabatan" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Tambah Data --}}

    {{-- Modal Edit Data --}}
    @foreach ($status_jabatans as $status)
        <div class="modal fade" id="modalEdit{{ $status->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Data Status Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('status_jabatan.update', $status->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4">
                                        <label for="status_jabatan" class="col-form-label text-nowrap">Status Jabatan</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="status_jabatan" name="status_jabatan"
                                            value="{{ $status->status_jabatan }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Modal Edit Data --}}

    {{-- Modal Hapus Data --}}
    @foreach ($status_jabatans as $status)
        <div class="modal fade" id="hapus{{ $status->id }}" tabindex="-1" aria-labelledby="hapusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Hapus Data Status Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('status_jabatan.destroy', $status->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <i>Apakah Anda Yakin Ingin Menghapus Data {{ $status->status_jabatan }}?</i>
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
    {{-- End Modal Hapus Data --}}

    {{-- Tabel --}}
    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x:auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th><b>NO</b></th>
                            <th>Status Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($status_jabatans as $status)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $status->status_jabatan }}</td>
                                <td>
                                    <!-- Button Edit -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $status->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- Button Hapus -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $status->id }}"> <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End Tabel --}}
@endsection
