@extends('admin.layout.main')

@section('content')

<div class="pagetitle">
    <h1>Tambah Pegawai</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item">Data Pegawai</li>
        </ol>
    </nav>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('pegawai.tambah') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Identitas Diri --}}
    <div class="card rounded-4">
        <div class="card-header rounded-4">Identitas Diri</div>
        <div class="card-body">
            <!-- Nama -->
            <div class="row mb-3">
                <label for="nama_pegawai" class="col-sm-3 col-form-label" style="color: black;">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required>
                </div>
            </div>

            <!-- NUPTK -->
            <div class="row mb-3">
                <label for="nuptk" class="col-sm-3 col-form-label" style="color: black;">NUPTK</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nuptk" name="nuptk" required>
                </div>
            </div>

            <!-- NIP/NBM -->
            <div class="row mb-3">
                <label for="nbm" class="col-sm-3 col-form-label" style="color: black;">NIP/NBM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nbm" name="nbm" required>
                </div>
            </div>

            <!-- Tempat, Tanggal Lahir -->
            <div class="row mb-3">
                <label for="tempat" class="col-sm-3 col-form-label" style="color: black;">Tempat, Tanggal Lahir
                    </label>
                <div class="col-sm-5">
                    <!-- Input untuk Tempat -->
                    <input type="text" class="form-control" id="tempat" name="tempat"
                        placeholder="Masukkan Tempat" required>
                </div>
                <div class="col-sm-4">
                    <!-- Input untuk Tanggal -->
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <input type="hidden" name="ttl" id="ttl">
            </div>

            <!-- Alamat -->
            <div class="row mb-3">
                <label for="alamat" class="col-sm-3 col-form-label" style="color: black;">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="row mb-3">
                <label for="jk" class="col-sm-3 col-form-label" style="color: black;">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <select class="form-control" id="jk" name="jk" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            {{-- status perkawinan --}}
            <div class="row mb-3">
                <label for="status_perkawinan" class="col-sm-3 col-form-label" style="color: black;">Status
                    Perkawinan</label>
                <div class="col-sm-9">
                    <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                        <option value="">Pilih Status Pernikahan</option>
                        <option value="Sudah Menikah">Sudah Menikah</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Pernah Menikah">Pernah Menikah</option>
                    </select>
                </div>
            </div>

            <!-- No HP -->
            <div class="row mb-3">
                <label for="no_hp" class="col-sm-3 col-form-label" style="color: black;">No HP</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                </div>
            </div>
        </div>
    </div>

    {{-- Riwayat Pendidikan  --}}
    <div class="card rounded-4">
        <div class="card-header rounded-4">Riwayat Pendidikan</div>
        <div class="card-body">
            <!-- Pendidikan Terakhir -->
            <div class="row mb-3">
                <label for="pendidikan_terakhir" class="col-sm-3 col-form-label" style="color: black;">Pendidikan Terakhir</label>
                <div class="col-sm-9">
                    <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                        <option value="">Pilih Pendidikan Terakhir</option>
                        <option value="SMA">SMA</option>
                        <option value="SMK">SMK</option>
                        <option value="S1">S1</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="jurusan" class="col-sm-3 col-form-label" style="color: black;">Jurusan</label>
                <div class="col-sm-9">
                    <select class="form-control" id="jurusan" name="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                    </select>
                </div>
            </div>            
        </div>            
    </div>            

    {{-- Jabatan --}}
    <div class="card rounded-4">
        <div class="card-header rounded-4">Jabatan</div>
        <div class="card-body">
            <!-- Jabatan -->
            <div class="row mb-3">
                <label for="jabatan_id" class="col-sm-3 col-form-label" style="color: black;">Jabatan</label>
                <div class="col-sm-9">
                    <select name="jabatan_id" id="jabatan_id" class="form-control">
                        <option value="">Pilih Jabatan</option>
                        @foreach ($jabatan as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Status jabatan --}}
            <div class="row mb-3">
                <label for="jabatan_id" class="col-sm-3 col-form-label" style="color: black;">Status Jabatan</label>
                <div class="col-sm-9">
                    <select name="status_jabatan_id" id="status_jabatan_id" class="form-control">
                        <option value="">Pilih Status Jabatan</option>
                        @foreach ($status_jabatan as $data)
                            <option value="{{ $data->id }}">{{ $data->status_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- status karyawan --}}
            <div class="row mb-3">
                <label for="status_karyawan" class="col-sm-3 col-form-label" style="color: black;">Status Karyawan</label>
                <div class="col-sm-9">
                    <select class="form-control" id="status_karyawan" name="status_karyawan" required>
                        <option value="">Pilih Status Karyawan</option>
                        <option value="K">Karyawan</option>
                        <option value="TK">Tidak Karyawan</option>
                    </select>
                </div>
            </div>

            <!-- Golongan -->
            <div class="row mb-3">
                <label for="golongan_id" class="col-sm-3 col-form-label" style="color: black;">Golongan</label>
                <div class="col-sm-9">
                    <select name="golongan_id" id="golongan_id" class="form-control">
                        <option value="">Pilih Golongan</option>
                        @foreach ($golongan as $data)
                            <option value="{{ $data->id }}">{{ $data->golongan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="row mb-3">
                <label for="mapel_id" class="col-sm-3 col-form-label" style="color: black;">Mata Pelajaran</label>
                <div class="col-sm-9">
                    <select name="mapel_id" id="mapel_id" class="form-control">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach ($mapel as $data)
                            <option value="{{ $data->id }}">{{ $data->mapel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

   {{-- Sertifikasi --}}
<div class="card rounded-4">
    <div class="card-header rounded-4">Sertifikasi</div>
    <div class="card-body">
        <!-- Tahun Sertifikasi -->
        <div class="row mb-3">
            <label for="tahun_sertifikasi" class="col-sm-3 col-form-label" style="color: black;">Tahun Sertifikasi</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="tahun_sertifikasi" name="tahun_sertifikasi">
            </div>
        </div>

        <!-- Tempat Sertifikasi -->
        <div class="row mb-3">
            <label for="tempat_sertifikasi" class="col-sm-3 col-form-label" style="color: black;">Tempat Sertifikasi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="tempat_sertifikasi" name="tempat_sertifikasi">
            </div>
        </div>

        <!-- Mengajar Sekolah Lain -->
        <div class="row mb-3">
            <label for="mengajar_sekolah_lain" class="col-sm-3 col-form-label" style="color: black;">Mengajar Sekolah Lain</label>
            <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mengajar_sekolah_lain" id="ya" value="Ya">
                    <label class="form-check-label" for="ya">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mengajar_sekolah_lain" id="tidak" value="Tidak" checked>
                    <label class="form-check-label" for="tidak">Tidak</label>
                </div>
            </div>
        </div>

        <!-- Nama Tempat Mengajar Sekolah Lain (Conditional) -->
        <div class="row mb-3 d-none" id="nama-sekolah-container">
            <label for="sekolah_lain" class="col-sm-3 col-form-label" style="color: black;">Nama  Mengajar Sekolah Lain</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="sekolah_lain" name="sekolah_lain">
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary me-2">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk radio button
        $('input[name="mengajar_sekolah_lain"]').on('change', function() {
            const isMengajar = $(this).val() === 'Ya';
            if (isMengajar) {
                $('#nama-sekolah-container').removeClass('d-none'); // Tampilkan input jika "Ya"
            } else {
                $('#nama-sekolah-container').addClass('d-none'); // Sembunyikan input jika "Tidak"
                $('#sekolah_lain').val(''); // Kosongkan nilai input
            }
        });
    });
    $(document).ready(function() {
        // Saat pengguna mengisi tempat atau tanggal lahir
        $('#tempat, #tanggal_lahir').on('change', function() {
            const tempat = $('#tempat').val(); // Ambil nilai tempat
            const tanggal = $('#tanggal_lahir').val(); // Ambil nilai tanggal
            if (tempat && tanggal) {
                const ttl = `${tempat}, ${tanggal}`; // Gabungkan tempat dan tanggal
                $('#ttl').val(ttl); // Isi input hidden TTL
            }
        });
    });
    $(document).ready(function() {
        // Data jurusan berdasarkan pendidikan terakhir
        const jurusanOptions = {
            SMA: [
                "IPA (Ilmu Pengetahuan Alam)",
                "IPS (Ilmu Pengetahuan Sosial)",
                "Bahasa dan Sastra",
                "Agama",
                "Lainnya"
            ],

            SMK: [
                "Teknik Komputer dan Jaringan",
                "Rekayasa Perangkat Lunak",
                "Multimedia",
                "Akuntansi",
                "Perhotelan",
                "Pariwisata",
                "Administrasi Perkantoran",
                "Farmasi",
                "Kesehatan",
                "Teknik Kendaraan Ringan",
                "Teknik Mesin",
                "Teknik Elektro",
                "Tataboga",
                "Tata Busana",
                "Animasi",
                "Teknik Jaringan Akses Telekomunikasi",
                "Broadcasting",
                "Lainnya"
            ],

            S1: [
                "Teknik Informatika",
                "Sistem Informasi",
                "Teknik Sipil",
                "Manajemen",
                "Akuntansi",
                "Ekonomi",
                "Pendidikan Matematika",
                "Pendidikan Bahasa Inggris",
                "Pendidikan Guru SD",
                "Kedokteran",
                "Keperawatan",
                "Farmasi",
                "Hukum",
                "Ilmu Komunikasi",
                "Psikologi",
                "Sastra Indonesia",
                "Sastra Inggris",
                "Arsitektur",
                "Teknik Elektro",
                "Teknik Mesin",
                "Desain Grafis",
                "Ilmu Politik",
                "Administrasi Publik",
                "Biologi",
                "Fisika",
                "Kimia",
                "Lainnya"
            ]
        };

        // Event handler untuk pendidikan terakhir
        $('#pendidikan_terakhir').on('change', function() {
            const selectedPendidikan = $(this).val(); // Ambil nilai pendidikan terakhir
            const jurusanDropdown = $('#jurusan'); // Ambil dropdown jurusan

            // Kosongkan dropdown jurusan
            jurusanDropdown.empty();
            jurusanDropdown.append('<option value="">Pilih Jurusan</option>');

            // Jika ada pilihan pendidikan terakhir, isi dropdown jurusan
            if (selectedPendidikan && jurusanOptions[selectedPendidikan]) {
                jurusanOptions[selectedPendidikan].forEach(function(jurusan) {
                    jurusanDropdown.append(`<option value="${jurusan}">${jurusan}</option>`);
                });
            }
        });
    });
</script>

@endsection
