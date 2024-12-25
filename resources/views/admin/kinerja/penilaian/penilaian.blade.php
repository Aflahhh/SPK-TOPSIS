@extends('admin.layout.main')

@section('content')

 <!-- Data Pegawai -->
 <div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <strong>DATA PEGAWAI</strong>
    </div>
    <div class="card-body mt-3">
        <table class="table table-bordered mb-0">
            <tr>
                <th width="30%">Nama Pegawai</th>
                <td>#</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>##</td>
            </tr>
            <tr>
                <th>Golongan</th>
                <td>{{ $pegawai->golongan->golongan }}</td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>2024</td>
            </tr>
        </table>
    </div>
</div>

<!-- Supervisi Pelaksanaan Pembelajaran -->
{{-- <div class="card">
    <div class="card-header bg-info text-white">
        <strong>SUPERVISI PELAKSANAAN PEMBELAJARAN</strong>
    </div>
    <div class="card-body mt-3">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">Aspek yang Diamati</th>
                    <th rowspan="2" class="align-middle">Kegiatan Pendahuluan</th>
                    <th colspan="5">Skor</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Apresiasi dan Motivasi</td>
                    <td>Pengamatan Apresiasi dan Motivasi</td>
                    <td><input type="radio" name="aspek1" value="1"></td>
                    <td><input type="radio" name="aspek1" value="2"></td>
                    <td><input type="radio" name="aspek1" value="3"></td>
                    <td><input type="radio" name="aspek1" value="4"></td>
                </tr>
                <tr>
                    <td>Apresiasi dan Motivasi</td>
                    <td>Pengamatan Penyampaian Kompetensi</td>
                    <td><input type="radio" name="aspek2" value="1"></td>
                    <td><input type="radio" name="aspek2" value="2"></td>
                    <td><input type="radio" name="aspek2" value="3"></td>
                    <td><input type="radio" name="aspek2" value="4"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div> --}}


@endsection