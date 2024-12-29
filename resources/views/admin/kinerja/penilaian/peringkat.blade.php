@extends('admin.layout.main')

@section('content')
    {{-- Toast Notification --}}
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Card --}}
    <div class="card rounded-4" style="height: 90px;">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data Pemeringkatan Pegawai</h5>
            </div>
        </div>  
    </div>

    {{-- Data Table --}}
    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x: auto;">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" rowspan="2">No</th>
                            <th class="text-center align-middle" rowspan="2">Pegawai</th>
                            <th class="text-center" colspan="{{ count($kriterias) }}">Total Per Kriteria</th>
                            <th class="text-center align-middle" rowspan="2">Total Skor</th>
                            <th class="text-center align-middle" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            @foreach ($kriterias as $kriteria)
                                    <th class="text-center">{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawais as $pegawai)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pegawai->nama_pegawai }}</td>
                                @foreach ($kriterias as $kriteria)
                                        <td class="text-center">{{ $kriteria->getTotal($pegawai->id) }}</th>
                                @endforeach
                                <td class="text-center">
                                    {{ $pegawai->getSkor() }}
                                </td>
                                <td class="text-center">
                                    <a href="peringkat/{{ $pegawai->id }}" class="btn btn-primary">
                                        <i class="bi bi-info"></i> Selengkapnya
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
