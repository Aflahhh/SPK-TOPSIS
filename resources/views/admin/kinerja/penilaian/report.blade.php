<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penilaian Perilaku Kerja</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; }
        .header, .footer { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h3>Penilaian Perilaku Kerja</h3>
        <p>Pegawai dan Guru Muhammadiyah</p>
    </div>

    <table>
        <tr>
            <th colspan="2">Data Pegawai</th>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $pegawai->nama_pegawai }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>{{ $pegawai->nip }}</td>
        </tr>
        <tr>
            <td>Mata Pelajaran</td>
            <td>{{ $pegawai->mapel->mapel }}</td>
        </tr>
    </table>

    @foreach($kriterias as $kriteria)
        <table>
            <tr>
                <th colspan="4">{{ $kriteria->nama_kriteria }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Sub-Kriteria</th>
                <th>Nilai</th>
                <th>Sebutan</th>
            </tr>
            @foreach($kriteria->subKriteria as $index => $sub)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $sub->nama_subkriteria }}</td>
                    <td>{{ $sub->nilai ?? 'N/A' }}</td>
                    <td>{{ $sub->sebutan ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach

    <div class="footer">
        <p>Kudus, {{ date('d M Y') }}</p>
        <p>Pejabat Penilai</p>
        <br><br>
        <p>___________________________</p>
    </div>
</body>
</html>
