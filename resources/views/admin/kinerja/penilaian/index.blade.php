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
                <h5 class="card-title" style="font-size: 24px;">Data Penilaian Kinerja</h5>
            </div>
        </div>  
    </div>

    {{-- Data Table --}}
    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x: auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Pegawai</th>
                            <th>Kriteria</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawais as $pegawai)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pegawai->nama_pegawai }}</td>
                                <td>
                                    <table>
                                        @foreach ($kriterias as $kriteria)
                                            <tr>
                                                <td class="{{ $loop->iteration !== 1 ? 'pt-3' : '' }}">
                                                    <span class="fw-bold">{{ $kriteria->nama_kriteria }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                @foreach ($kriteria->subkriterias as $sub)
                                                        <tr>
                                                            <td>
                                                                <li>{{ $sub->nama_subkriteria }}</li>
                                                            </td>
                                                            <td class="px-3">:</td>
                                                            <td>{{ $sub->getBobot($pegawai->id) }}</td>
                                                        </tr>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td class="text-center">
                                    <a href="/kinerja/penilaian/{{ $pegawai->id }}" class="btn btn-primary">
                                        <i class="bi bi-pencil"></i> Ubah Bobot
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
