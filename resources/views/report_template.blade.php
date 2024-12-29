<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penilaian Kinerja Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .section-title {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penilaian Kinerja Pegawai</h1>
        <p>Periode: {{ now()->format('F Y') }}</p>
    </div>

    <div class="section-title">Data Pegawai</div>
    <table class="table">
        <tr>
            <th>NIP</th>
            <td>{{ $pegawai->nip }}</td>
        </tr>
        <tr>
            <th>Nama Pegawai</th>
            <td>{{ $pegawai->nama_pegawai }}</td>
        </tr>
        <tr>
            <th>Mata Pelajaran</th>
            <td>{{ $pegawai->mapel->mapel }}</td>
        </tr>
    </table>

    <div class="section-title">Penilaian Kinerja</div>
    @foreach($kriterias as $kriteria)
        <h3>{{ $kriteria->nama_kriteria }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Aspek yang Diamati</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriteria->subkriteria as $index => $subkriteria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $subkriteria->nama_subkriteria }}</td>
                        <td>{{ $subkriteria->getBobot($pegawai->id) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

</body>
</html>
