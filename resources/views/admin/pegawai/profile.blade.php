@extends('admin.layout.main')
@section('content')
    <div class="pagetitle">
        <h1>Profil Pegawai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Data Pegawai</a></li>
                <li class="breadcrumb-item">Profil</li>
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

                            <div class="row">
                                <div class="col-lg-4 col-md-5 label ">Nama Lengkap</div>
                                <div class="col-lg-8 col-md-7">{{ $data->nama_pegawai }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">NUPTK</div>
                                <div class="col-lg-8 col-md-7">{{ $data->nuptk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">NIP</div>
                                <div class="col-lg-8 col-md-7">{{ $data->nip }}</div>
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
                                <div class="col-lg-4 col-md-5 label">No HP</div>
                                <div class="col-lg-8 col-md-7">{{ $data->no_hp }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Alamat</div>
                                <div class="col-lg-8 col-md-7">{{ $data->alamat }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Provinsi</div>
                                <div class="col-lg-8 col-md-7"><select class="form-control" id="prov_id" name="prov_id"
                                        disabled>
                                        @foreach ($provinces as $prov)
                                            <option value="{{ $prov->id }}"
                                                {{ $data->prov_id == $prov->id ? 'selected' : '' }}>{{ $prov->name }}
                                            </option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Kabupaten</div>
                                <div class="col-lg-8 col-md-7"><select class="form-control" id="prov_id" name="prov_id"
                                        disabled>
                                        @foreach ($kabupaten as $kab)
                                            <option value="{{ $kab->id }}"
                                                {{ $data->kab_id == $kab->id ? 'selected' : '' }}>{{ $kab->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Kecamatan</div>
                                <div class="col-lg-8 col-md-7">
                                    <select class="form-control" id="kec_id" name="kec_id" disabled>
                                        @foreach ($kecamatan as $kec)
                                            <option value="{{ $kec->id }}"
                                                {{ $data->kec_id == $kec->id ? 'selected' : '' }}>{{ $kec->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Desa</div>
                                <div class="col-lg-8 col-md-7">
                                    <select class="form-control" id="desa_id" name="desa_id" disabled>
                                        @foreach ($desa as $d)
                                            <option value="{{ $d->id }}"
                                                {{ $data->desa_id == $d->id ? 'selected' : '' }}>{{ $d->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Alamat</div>
                                <div class="col-lg-8 col-md-7">{{ $data->alamat }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Riwayat Pendidikan</div>
                                <div class="col-lg-8 col-md-7">
                                    @forelse($data->pendidikan as $pendidikan)
                                        <div>{{ $pendidikan->nama_sekolah }} / {{ $pendidikan->pendidikan_jurusan }}
                                            ({{ $pendidikan->pendidikan_masuk }} -
                                            {{ $pendidikan->pendidikan_keluar }})
                                        </div>
                                    @empty
                                        <div>- Tidak ada riwayat pendidikan</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Riwayat Pekerjaan</div>
                                <div class="col-lg-8 col-md-7">
                                    @forelse($pekerjaan->pekerjaan as $pekerjaan)
                                        <div>{{ $pekerjaan->nama_perusahaan }} / {{ $pekerjaan->posisi }}
                                            ({{ $pekerjaan->pekerjaan_masuk }} - {{ $pekerjaan->pekerjaan_keluar }})
                                        </div>
                                    @empty
                                        <div>- Tidak ada riwayat pekerjaan</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Jabatan</div>
                                <div class="col-lg-8 col-md-7">
                                    {{ $data->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Status Jabatan</div>
                                <div class="col-lg-8 col-md-7">
                                    @if ($data->statusJabatan)
                                        {{ $data->statusJabatan->status_jabatan }}
                                    @else
                                        -
                                    @endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Golongan</div>
                                <div class="col-lg-8 col-md-7">{{ $data->golongan->golongan ?? 'Tidak ada golongan' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Mapel</div>
                                </label>
                                <div class="col-lg-8 col-md-7">
                                    @forelse ($mapel as $data)
                                        <div>{{ $data->mapel }}</div>
                                    @empty
                                        <div>- Tidak ada mata pelajaran</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Tanggal Masuk</div>
                                <div class="col-lg-8 col-md-7">
                                    {{ formatTanggalIndo($tgl_masuk) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-5 label">Tanggal Pensiun</div>
                                <div class="col-lg-8 col-md-7">
                                    {{ formatTanggalIndo($pensiun) }}
                                </div>
                            </div>



                        </div>

                    </div>
                </div>

            </div>


        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ambil nilai TTL dari input hidden
            const ttl = $("#ttl").val();

            if (ttl) {
                // Pisahkan string berdasarkan ", "
                const [tempat, tanggal] = ttl.split(", "); // tempat = "Kudus", tanggal = "2000-02-10"

                // Parsing tanggal
                const date = new Date(tanggal);

                // Tambahkan 60 tahun ke tanggal
                date.setFullYear(date.getFullYear() + 60);

                // Format tanggal menjadi dd-mm-yyyy
                const formattedDate = date.toLocaleDateString("id-ID", {
                    day: "2-digit",
                    month: "2-digit",
                    year: "numeric",
                });

                // Tampilkan hasil ke elemen HTML
                $("#perkiraanPensiun").text(formattedDate);
            }
        });

        $(document).ready(function() {
            // Cari semua elemen dengan kelas "form-control" yang memiliki atribut "disabled"
            $(".form-control:disabled").css({
                background: "#fff",
                border: "none"
            });
        });
    </script>
@endsection
