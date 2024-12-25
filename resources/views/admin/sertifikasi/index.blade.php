
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
    

    <div class="card rounded-4" style="height: 90px" >
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;" >Data Jabatan</h5>
                <div class="d-flex ">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-info rounded-5 ms-2" onclick="window.location.href='/sertifikasi/addData'"
                        >Tambah</i>
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
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Nama Sertifikasi</th>
                            <th>Tanggal Sertifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sertifikasi as $sertifikasi)
                            <tr>
                                <td>{{ $sertifikasi->nip }}</td>
                                <td>{{ $sertifikasi->nama_pegawai }}</td>
                                <td>{{ $sertifikasi->jabatan }}</td>
                                <td>{{ $sertifikasi->nama_sertifikasi }}</td>
                                <td>{{ $sertifikasi->tgl_sertifikasi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    
@endsection

