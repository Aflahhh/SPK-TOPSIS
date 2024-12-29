@extends('admin.layout.main')
@section('content')
    <div class="pagetitle">
        <h1>Profil Pegawai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Data Pegawai</a></li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-12">
                <div class="card rounded-4">
                    <div class="card-body">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title"></h5>

                            <!-- Identitas Diri -->
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label ">Nama Lengkap</div>
                                <div class="col-lg-8 col-md-7">{{ $data->nama_pegawai }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">NUPTK</div>
                                <div class="col-lg-8 col-md-7">{{ $data->nuptk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">NBM</div>
                                <div class="col-lg-8 col-md-7">{{ $data->nbm }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Alamat</div>
                                <div class="col-lg-8 col-md-7">{{ $data->alamat }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Tempat, Tanggal Lahir</div>
                                <div class="col-lg-8 col-md-7">
                                    @php
                                        $parts = explode(', ', $data->ttl);
                                        $tempat = $parts[0] ?? '-';
                                        $tanggal = $parts[1] ?? null;
                                        $formattedTanggal = app(
                                            'App\Http\Controllers\PegawaiController',
                                        )->formatTanggalIndo($tanggal);
                                    @endphp
                                    {{ $tempat }}, {{ $formattedTanggal }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Jenis Kelamin</div>
                                <div class="col-lg-8 col-md-7">{{ $data->jk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Status Perkawinan</div>
                                <div class="col-lg-8 col-md-7">{{ $data->status_perkawinan }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">No HP</div>
                                <div class="col-lg-8 col-md-7">{{ $data->no_hp }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Pendidikan Terakhir</div>
                                <div class="col-lg-8 col-md-7">{{ $data->pendidikan_terakhir }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Jurusan</div>
                                <div class="col-lg-8 col-md-7">{{ $data->jurusan }}</div>
                            </div>

                            <!-- Jabatan dan Sertifikasi -->
                            <h5 class="card-title mt-4">Jabatan dan Sertifikasi</h5>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Jabatan</div>
                                <div class="col-lg-8 col-md-7">{{ $data->jabatan->nama_jabatan ?? '-' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Status Jabatan</div>
                                <div class="col-lg-8 col-md-7">{{ $data->statusJabatan->status_jabatan ?? '-' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Status Karyawan</div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $data->status_karyawan === 'K' ? 'Karyawan' : ($data->status_karyawan === 'TK' ? 'Tidak Karyawan' : '-') }}
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Golongan</div>
                                <div class="col-lg-8 col-md-7">{{ $data->golongan->golongan ?? '-' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Mata Pelajaran</div>
                                <div class="col-lg-8 col-md-7">{{ $data->mapel->mapel ?? '-' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Tahun Sertifikasi</div>
                                <div class="col-lg-8 col-md-7">{{ $data->tahun_sertifikasi ?? '-' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Tempat Sertifikasi</div>
                                <div class="col-lg-8 col-md-7">{{ $data->tempat_sertifikasi ?? '-' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Mengajar di Sekolah Lain</div>
                                <div class="col-lg-8 col-md-7">{{ $data->mengajar_sekolah_lain }}</div>
                            </div>
                            @if ($data->mengajar_sekolah_lain === 'Ya')
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 label">Nama Sekolah Lain</div>
                                    <div class="col-lg-8 col-md-7">{{ $data->sekolah_lain }}</div>
                                </div>
                            @endif

                            <!-- Tanggal Masuk dan Pensiun -->
                            <h5 class="card-title mt-4">Pensiun</h5>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Tanggal</div>
                                <div class="col-lg-8 col-md-7"> {{ \Carbon\Carbon::parse($data->tgl_purna)->translatedFormat('d F Y') }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
