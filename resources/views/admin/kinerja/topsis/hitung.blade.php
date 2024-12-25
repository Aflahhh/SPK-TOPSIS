@extends('admin.layout.main')

@section('content')
<div class="container">
    <h1>Hitung Peringkat TOPSIS</h1>
    <form action="{{ route('topsis.hitung') }}" method="GET">
        <div class="form-group">
            <label for="periode">Pilih Periode Penilaian:</label>
            <input type="date" class="form-control" id="periode" name="periode" required>
        </div>
        <button type="submit" class="btn btn-primary">Hitung</button>
    </form>
</div>
@endsection