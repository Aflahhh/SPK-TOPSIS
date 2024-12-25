@extends('admin.layout.main')

@section('content')

<div class="container">
    <h2>Tambah Sertifikasi</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sertifikasi.tambah') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control" placeholder="Masukkan NIP" required>
        </div>
        <div class="form-group">
            <label for="nama_pegawai">Nama Pegawai</label>
            <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="nama_sertifikasi">Nama Sertifikasi</label>
            <input type="text" id="nama_sertifikasi" name="nama_sertifikasi" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tgl_sertifikasi">Tanggal Sertifikasi</label>
            <input type="date" id="tgl_sertifikasi" name="tgl_sertifikasi" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('input', '#nip', function () {
        var nip = $(this).val();

        if (nip) {
            $.ajax({
                url: "{{ route('sertifikasi.fetchPegawai') }}",
                type: "GET",
                data: { nip: nip },
                success: function (data) {
                    if (data.nama && data.jabatan) {
                        $('#nama_pegawai').val(data.nama);
                        $('#jabatan').val(data.jabatan);
                    } else {
                        $('#nama_pegawai').val('');
                        $('#jabatan').val('');
                    }
                },
                error: function () {
                    $('#nama_pegawai').val('');
                    $('#jabatan').val('');
                }
            });
        } else {
            $('#nama_pegawai').val('');
            $('#jabatan').val('');
        }
    });
</script>


@endsection
