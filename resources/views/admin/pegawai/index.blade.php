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
                <button type="button" class="btn btn-primary ms-2"
                    onclick="window.location.href='{{ route('pegawai.addData') }}'">Tambah Pegawai</i>
                </button>
            </div>
        </div>
    </div>


    {{-- modal hapus --}}
    @foreach ($pegawai as $data)
        <div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" aria-labelledby="HapusLabel{{ $data->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusLabel{{ $data->id }}">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <i>Apakah Anda Yakin Ingin Menghapus Data Pegawai {{ $data->nama_pegawai }}?</i>
                    </div>
                    <form action="{{ url('masterPegawai/hapus/' . $data->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Hapus Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal hapus --}}

    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x:auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NUPTK</th>
                            <th>NBM</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach ($pegawai as $data)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $data->nama_pegawai }}</td>
                                <td>{{ $data->nuptk }}</td>
                                <td>{{ $data->nbm }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>
                                    <a href="{{ route('pegawai.edit', $data->id) }}" class="btn btn-success">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('profile.pegawai', $data->id) }}" class="btn btn-warning">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $data->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener untuk perubahan filter
            $('#filter').on('change', function() {
                const filterValue = $(this).val(); // Ambil nilai dari select
                const url = filterValue ?
                    `{{ route('pegawai.index') }}?filter=${filterValue}` // Jika ada filter
                    :
                    `{{ route('pegawai.index') }}`; // Jika filter kosong

                // Redirect ke URL dengan filter
                window.location.href = url;
            });
        });
    </script>
@endsection
