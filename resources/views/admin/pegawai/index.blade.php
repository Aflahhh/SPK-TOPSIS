@extends('admin.layout.main')

@section('content')
    {{-- toast --}}
    @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('berhasil'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('selesai'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Data Berhasil Dihapus
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="card rounded-4" style="height: 90px">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data Pegawai</h5>
                <div class="d-flex ">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-primary rounded-3 ms-2"
                        onclick="window.location.href='/pegawai/addData'">Tambah Data</i>
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
                            <th>No</th>
                            <th>Nama</th>
                            <th>NUPTK</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>
                                <b>Aksi </b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($pegawai as $data)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $data->nama_pegawai }}</td>
                                <td>{{ $data->nuptk }}</td>
                                <td>{{ $data->nip }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>

                                    {{-- Button Edit --}}
                                    <a href="{{ route('pegawai.edit', $data->id) }}" class="btn btn-success">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="{{ route('profile.pegawai', $data->id) }}" class="btn btn-warning">
                                        <i class="bi bi-eye"></i>
                                    </a>

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

    @include('admin.pegawai.hapus')
@endsection
