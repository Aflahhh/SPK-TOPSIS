@extends('admin.layout.main')

@section('content')

<style>
    .datatable-table > thead > tr > th,
    .datatable-table > tbody > tr > td {
        text-align: center
    }
</style>

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
                <h5 class="card-title" style="font-size: 24px;">Data Pegawai Pensiun</h5>
            </div>
        </div>  
    </div>    

    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x:auto;">
                <table class="table datatable table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Umur</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Pensiun</th>
                            <th>Status Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pegawai as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_pegawai }}</td>
                                <td>{{ $data->nbm ?? 'Tidak Diketahui' }}</td>
                                @php
                                $ttlParts = explode(', ', $data->ttl); // Pisahkan tempat dan tanggal
                                $tanggalLahir = $ttlParts[1] ?? null; // Ambil tanggal lahir
                            @endphp
                                <td class="tanggal-lahir" data-tanggal="{{ $tanggalLahir }}"></td>
                                <td>{{ \Carbon\Carbon::parse($data->tgl_pengajuan)->format('d-m-Y') }}</td>
                                <td>{{ $data->tgl_purna }}</td>
                                <td>{{ $data->statusJabatan->status_jabatan ?? 'Tidak Ada Status' }}</td>
                                <td class="d-flex gap-1 justify-content-center">
                                    <button class="btn btn-secondary btn-sm">Lanjut</button>
                                    <a href="" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('pensiun.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></button>
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

    <script>
        function hitungUmur(tanggalLahir) {
        const today = new Date(); // Tanggal hari ini
        const birthDate = new Date(tanggalLahir); // Ubah string ke format Date
        let umur = today.getFullYear() - birthDate.getFullYear(); // Selisih tahun
        const monthDiff = today.getMonth() - birthDate.getMonth(); // Selisih bulan

        // Jika bulan atau tanggal belum lewat di tahun ini, kurangi umur
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            umur--;
        }

        return umur + " Tahun";
    }

    // Menjalankan perhitungan umur untuk setiap elemen dengan class "tanggal-lahir"
    document.addEventListener("DOMContentLoaded", function () {
        const rows = document.querySelectorAll(".tanggal-lahir"); // Ambil semua elemen dengan class tanggal-lahir
        rows.forEach(row => {
            const tanggalLahir = row.dataset.tanggal; // Ambil atribut data-tanggal
            const umur = hitungUmur(tanggalLahir); // Hitung umur
            row.textContent = umur; // Masukkan hasil umur ke dalam elemen
        });
    }); 
    </script>

@endsection
