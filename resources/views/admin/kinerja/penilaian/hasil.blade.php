@extends('admin.layout.main')

@section('content')
    <h4>Hasil Penilaian Kinerja</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Nilai Penilaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preferensi as $pegawaiId => $nilai)
                <tr>
                    <!-- Access pegawai by ID directly -->
                    <td>{{ $pegawai->firstWhere('id', $pegawaiId)->nama_pegawai }}</td>
                    <td>{{ number_format($nilai, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
