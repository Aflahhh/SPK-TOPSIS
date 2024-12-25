@extends('admin.layout.main')

@section('content')
    {{-- toast --}}
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
    {{-- end toast --}}

    <div class="card rounded-4" style="height: 90px">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data User</h5>
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

    {{-- modal tambah data --}}
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row mb-3 align-items-center">
                                <div class="col-4">
                                    <label for="username" class="col-sm-4 col-form-label text-nowrap">Username</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-4">
                                    <label for="password" class="col-sm-4 col-form-label text-nowrap">Password</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-4">
                                    <label for="role" class="col-sm-4 col-form-label text-nowrap">Role</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="role" id="role" class="form-select">
                                        <option value="">Pilih Role</option>
                                        <option value="kepsek">Kepsek</option>
                                        <option value="tu">TU</option>
                                    </select>
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
    {{-- end modal tambah data --}}

    {{-- modal edit data --}}
    @foreach ($users as $user)
        <div class="modal fade" id="modalEdit{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4">
                                        <label for="username" class="col-sm-4 col-form-label text-nowrap">Username</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ $user->username }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4">
                                        <label for="password" class="col-sm-4 col-form-label text-nowrap">Password</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4">
                                        <label for="role" class="col-sm-4 col-form-label text-nowrap">Role</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="role" id="role" class="form-select">
                                            <option value="kepsek" {{ $user->role == 'kepsek' ? 'selected' : '' }}>Kepsek
                                            </option>
                                            <option value="tu" {{ $user->role == 'tu' ? 'selected' : '' }}>TU</option>
                                        </select>
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
    {{-- end modal edit data --}}

    {{-- modal hapus data --}}
    @foreach ($users as $user)
        <div class="modal fade" id="hapus{{ $user->id }}" tabindex="-1" aria-labelledby="hapusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Hapus Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <i>Apakah Anda Yakin Ingin Menghapus Data {{ $user->username }}?</i>
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
    {{-- end modal hapus data --}}

    {{-- table --}}
    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x:auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th><b>NO</b></th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td><?= ++$no ?></td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <!-- Button Edit -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $user->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- Button Hapus -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $user->id }}"> <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- end table --}}
@endsection
