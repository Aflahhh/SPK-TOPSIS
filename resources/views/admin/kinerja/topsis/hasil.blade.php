@extends('admin.layout.main')


@section('content')

<div class="container mt-4">
    <h4 class="mb-4">Hasil Perhitungan TOPSIS</h4>

    @if(isset($preference))
        <div class="alert alert-success">
            <p>Skor preferensi alternatif adalah: {{ $preference }}</p>
        </div>
    @else
        <div class="alert alert-danger">
            <p>Tidak ada data yang dapat dihitung.</p>
        </div>
    @endif
</div>



{{-- <div class="container">
    <h1>Hasil Peringkat TOPSIS</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Nilai Preferensi</th>
                <th>Peringkat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topsisResults as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result->pegawai->nama }}</td>
                    <td>{{ number_format($result->nilai_preferensi, 4) }}</td>
                    <td>{{ $result->peringkat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
@endsection
