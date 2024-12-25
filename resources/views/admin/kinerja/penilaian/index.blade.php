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
                            <th>Pegawai</th>
                            <th>Subkriteria</th>
                            <th>Skor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaian as $item)
                        <tr>
                            <td>{{ $item->pegawai->nama_pegawai }}</td>
                            {{-- <td>{{ $item->kriteria->nama_kriteria }}</td> --}}
                            <td>{{ $item->nilai }}</td>
                            {{-- <td>
                                <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

