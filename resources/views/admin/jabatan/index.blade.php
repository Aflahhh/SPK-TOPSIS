@extends('admin.layout.main')

@section('content')
    {{-- toast --}}
    @if (session()->has('tambah'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('hapus'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="card rounded-4" style="height: 90px">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data Jabatan</h5>
                <div class="d-flex ">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-primary rounded-3 ms-2" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                        Tambah Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah jabatan --}}
    @foreach ($jb as $data)
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Data Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('jabatan.tambah') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3 align-items-center">
                                <label for="nama_jabatan" class="col-sm-4 col-form-label text-nowrap">Jabatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                                        required>
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
    @endforeach
    {{-- end modal tambah jabatan --}}

    {{-- modal edit jabatan --}}
    @foreach ($jb as $data)
        <div class="modal fade" id="edit{{ $data->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('master/jabatan/edit/' . $data->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="card-body" style="margin-top: 10px;">
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label" style="color: grey;">Nama Jabatan</label>
                                    <input class="form-control" type="text" id="nama_jabatan" name="nama_jabatan"
                                        value="{{ $data->nama_jabatan }}" autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit jabatan --}}

    {{-- modal hapus jabatan --}}
    @foreach ($jb as $data)
        <div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" aria-labelledby="hapusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Hapus Data Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('master/jabatan/hapus/' . $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <i>Apakah Anda Yakin Ingin Menghapus Data?</i>
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
    {{-- end modal hapus jabatan --}}

    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x:auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th><b>NO</b></th>
                            <th>Nama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($jb as $data)
                            <tr>
                                <td><?= ++$no ?></td>
                                <td>{{ $data->nama_jabatan }}</td>
                                <td>
                                    <!-- Button Edit -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $data->id }}"> <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- Button Hapus -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $data->id }}"> <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
