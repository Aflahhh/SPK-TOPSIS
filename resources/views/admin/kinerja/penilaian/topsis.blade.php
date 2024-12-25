@extends('admin.layout.main')

@section('content')
    <h4>Hasil Penilaian</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aspek yang Diamati</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $kriteria_id => $nilaiPreferensi)
                <tr>
                    <td>{{ $kriteria_id }}</td>
                    <td>{{ $nilaiPreferensi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
