@extends('admin.layout.main')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container mt-4">
    <!-- Judul Halaman -->
    <h4 class="mb-4">Aplikasi Supervisi Akademik Pegawai</h4>


    <form method="POST" action="{{ route('penilaian.create') }}">
        @csrf
        {{-- Data Pegawai --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <strong>DATA PEGAWAI</strong>
            </div>
            <div class="card-body mt-3">
                <div class="row mb-3">
                    <label for="nip" class="col-sm-2 col-form-label" style="color: black;">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_pegawai" class="col-sm-2 col-form-label" style="color: black;">Nama Pegawai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mapel" class="col-sm-2 col-form-label" style="color: black;">Mata Pelajaran</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="mapel" name="mapel" required>
                            <option value="" selected disabled>Pilih Mata Pelajaran</option>
                            @foreach($mapel as $data)
                                <option value="{{ $data->id }}">{{ $data->mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                
                <div class="row mb-3">
                    <label for="jml_tm" class="col-sm-2 col-form-label" style="color: black;">Jumlah tatap Muka</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jml_tm" name="jml_tm" required>
                    </div>
                </div>
            </div>
        </div>
        


        {{-- Kinerja --}}
        <div class="card">
            <div class="card-header bg-info text-white">
                <strong>SUPERVISI PENILAIAN KINERJA</strong>
            </div>
            <div class="card-body mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="table-primary">
                            <th rowspan="2" colspan="2" class="align-middle" style="width: 45%;">Aspek yang Diamati</th>
                            <th colspan="5" class="align-middle">Skor</th>
                        </tr>
                        <tr class="table-light">
                            <th style="width: 5%;">1</th>
                            <th style="width: 5%;">2</th>
                            <th style="width: 5%;">3</th>
                            <th style="width: 5%;">4</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriteria as $kriteria)
                            <tr class="bg-primary text-white fw-bold">
                                <td colspan="7" class="text-start">{{ $kriteria->nama_kriteria }}</td>
                            </tr>
                            
                            <!-- Row Sub-Kriteria -->
                            @foreach($kriteria->subkriteria as $index => $subkriteria)
                                <tr>
                                    <td style="width: 5%;">{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $subkriteria->nama_subkriteria }}</td>
                                    <!-- Hidden input for kriteria_id -->
                                    <input type="hidden" name="kriteria_id[{{ $subkriteria->id }}]" value="{{ $kriteria->id }}">
                                    <!-- Hidden input for nilai default value (0 or null) -->
                                    <input type="hidden" name="nilai[{{ $subkriteria->id }}]" value="0">
                                    <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="1"></td>
                                    <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="2"></td>
                                    <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="3"></td>
                                    <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="4"></td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>  
            </div>
        </div>

        
    </form>

    <!-- JavaScript get nama -->
    <script>
        // Event listener for NIP input
        document.getElementById('nip').addEventListener('input', function () {
            const nip = this.value;

            if (nip) {
                fetch(`{{ url('/kinerja/penilaian/get-data') }}?nip=${nip}`)
                    .then(response => response.json())
                    .then(data => {
                        // Check if data exists
                        if (data) {
                            document.getElementById('nama_pegawai').value = data.nama_pegawai || '';
                        } else {
                            // Clear the fields if no data found
                            document.getElementById('nama_pegawai').value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            } else {
                // Clear the fields if NIP is empty
                document.getElementById('nama_pegawai').value = '';
            }
        });
    </script> 





@endsection




