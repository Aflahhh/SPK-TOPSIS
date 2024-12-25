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
                <h5 class="card-title" style="font-size: 24px;">Data Pensiun</h5>
                <div class="d-flex">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-info rounded-5 ms-2" onclick="window.location.href='/pegawai/addData'"
                        >Tambah</i>
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
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Pensiun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pensiun as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama_pegawai ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $item->pegawai->nip ?? 'Tidak Diketahui' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_pensiun)->format('d-m-Y') }}</td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($item->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($item->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pensiun.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('pensiun.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data pensiun.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Include modal --}}
    @include('admin.pensiun.tambah')

@endsection
