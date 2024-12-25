@extends('admin.layout.main')

@section('content')
<div class="pagetitle">
    <h1>Data Pegawai</h1>
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

<form action="{{ route('pensiun.tambah') }}" method="POST" enctype="multipart/form-data" class="d-inline">
    @csrf 

    <div class="card rounded-4">
        <div class="card-body">
            <div class="card-body mt-4">
                <div class="row mb-3">
                    <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">  <!-- Memperkecil lebar input -->
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-10">  <!-- Memperkecil lebar input -->
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tlahir" class="col-sm-2 col-form-label" style="color: black;">Tempat, Tanggal Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="tlahir" name="tlahir" required>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="ttl" name="ttl" required onchange="calculateExitDate()">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mapel_id" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-10">  <!-- Memperkecil lebar input -->
                        <input type="text" class="form-control" id="mapel_id" name="mapel_id" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_pengajuan" class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                    <div class="col-sm-10">  <!-- Memperkecil lebar input -->
                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_pensiun" class="col-sm-2 col-form-label">Tanggal Akan Pensiun</label>
                    <div class="col-sm-10">  <!-- Memperkecil lebar input -->
                        <input type="date" class="form-control" id="tgl_pensiun" name="tgl_pensiun" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>


<script>
    document.getElementById('nip').addEventListener('change', function () {
        const nip = this.value;

        if (nip) {
            fetch(`/fetch-pegawai/${nip}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('pegawai_id').value = data.nama_pegawai;
                        document.getElementById('jabatan_id').value = data.nama_jabatan;
                        document.getElementById('golongan_id').value = data.golongan;
                        document.getElementById('mapel_id').value = data.mapel;
                    } else {
                        alert(data.message);
                        clearFields();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    clearFields();
                });
        } else {
            clearFields();
        }
    });

    function clearFields() {
        document.getElementById('pegawai_id').value = '';
        document.getElementById('jabatan_id').value = '';
        document.getElementById('golongan_id').value = '';
        document.getElementById('mapel_id').value = '';
    }
</script>
@endsection
