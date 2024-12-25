<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\jabatan;
use App\Models\golongan;
use App\Models\mapel;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        $jabatan = jabatan::all();
        $provinces = Province::all();

        return view('admin.pegawai.index', compact('pegawai',  'provinces', 'jabatan'));
    }

    public function addData()
    {  // menampilkan halaman tambah data pegawai
        $pegawai = Pegawai::all();
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $mapel = Mapel::all();
        $provinces = Province::all();

        return view('admin.pegawai.tambah', compact(
            'pegawai',
            'jabatan',
            'golongan',
            'mapel',
            'provinces'
        ));
    }

    public function create(Request $request)
    {
        $masuk = $request->validate([

            // data pegawai
            'nuptk' => 'required',
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'prov_id' => 'required',
            'kab_id' => 'required',
            'kec_id' => 'required',
            'desa_id' => 'required',
            'alamat' => 'required',
            'ttl' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
            'status_perkawinan' => 'required',
            'tgl_masuk' => 'required',

            // jabatan dan golongan
            'jabatan_id' => 'required',
            'status_jabatan' => 'required',
            'golongan_id' => 'required',
            'mapel_id' => 'required',

            // pendidikan
            'pendidikan_masuk' => 'required',
            'pendidikan_masuk.*' => 'required',
            'pendidikan_keluar' => 'nullable',
            'pendidikan_keluar.*' => 'nullable',
            'nama_sekolah' => 'required',
            'nama_sekolah.*' => 'required',
            'pendidikan_jurusan' => 'nullable',
            'pendidikan_jurusan.*' => 'nullable',

            // pekerjaan
            'pekerjaan_masuk' => 'required',
            'pekerjaan_masuk.*' => 'required',
            'pekerjaan_keluar' => 'nullable',
            'pekerjaan_keluar.*' => 'nullable',
            'nama_perusahaan' => 'required',
            'nama_perusahaan.*' => 'required',
            'posisi' => 'nullable',
            'posisi.*' => 'nullable',
        ]);


        $pegawai = new Pegawai();

        // Set data pegawai 
        $pegawai->nuptk = $masuk['nuptk'];
        $pegawai->nama_pegawai = $masuk['nama_pegawai'];
        $pegawai->nip = $masuk['nip'];
        $pegawai->prov_id = $masuk['prov_id'];
        $pegawai->kab_id = $masuk['kab_id'];
        $pegawai->kec_id = $masuk['kec_id'];
        $pegawai->desa_id = $masuk['desa_id'];
        $pegawai->alamat = $masuk['alamat'];
        $pegawai->ttl = $masuk['ttl'];
        $pegawai->jk = $masuk['jk'];
        $pegawai->no_hp = $masuk['no_hp'];
        $pegawai->status_perkawinan = $masuk['status_perkawinan'];
        $pegawai->tgl_masuk = Carbon::parse($masuk['tgl_masuk'])->format('d-m-Y');

        // Kalkulasi kemungkinan pensiun
        $retirementAge = 60;
        $ttl = $masuk['ttl']; // Contoh: "Kudus, 2000-03-20"
        // Pisahkan string berdasarkan ", "
        list($tempat, $tanggal) = explode(', ', $ttl); // $tempat = "Kudus", $tanggal = "2000-03-20"
        // Parsing tanggal menggunakan Carbon
        $retirementDate = Carbon::parse($tanggal)->addYears($retirementAge)->format('d-m-Y');
        // Simpan hasil ke properti
        $pegawai->tgl_keluar = $retirementDate;



        // Jabatan dan golongan
        $pegawai->jabatan_id = $masuk['jabatan_id'];
        $pegawai->status_jabatan = $masuk['status_jabatan'];
        $pegawai->golongan_id = $masuk['golongan_id'];
        $pegawai->mapel_id = $masuk['mapel_id'];

        $pegawai->save();


        // Simpan riwayat pendidikan
        foreach ($masuk['pendidikan_masuk'] as $index => $pendidikan_masuk) {
            Pendidikan::create([
                'pegawai_id' => $pegawai->id,
                'pendidikan_masuk' => $pendidikan_masuk,
                'pendidikan_keluar' => $masuk['pendidikan_keluar'][$index] ?? null,
                'nama_sekolah' => $masuk['nama_sekolah'][$index],
                'pendidikan_jurusan' => $masuk['pendidikan_jurusan'][$index] ?? null,
            ]);
        }


        // Simpan riwayat pekerjaan
        foreach ($masuk['pekerjaan_masuk'] as $index => $pekerjaan_masuk) {
            Pekerjaan::create([
                'pegawai_id' => $pegawai->id,
                'pekerjaan_masuk' => $pekerjaan_masuk,
                'pekerjaan_keluar' => $masuk['pekerjaan_keluar'][$index] ?? null,
                'nama_perusahaan' => $masuk['nama_perusahaan'][$index],
                'posisi' => $masuk['posisi'][$index] ?? null,
            ]);
        }

        return redirect()->route('pegawai.index')->with('tambah', 'Data Berhasil Ditambahkan');
    }

    public function profile($id)
    {
        // Ambil data pegawai berdasarkan ID
        $data = Pegawai::findOrFail($id);

        // Kalkulasi kemungkinan pensiun
        $retirementAge = 60;
        if (!empty($data->ttl)) {
            // Pisahkan string berdasarkan ", "
            list($tempat, $tanggal) = explode(', ', $data->ttl); // $tempat = "Kudus", $tanggal = "2000-03-20"
            // Parsing tanggal menggunakan Carbon
            $retirementDate = Carbon::parse($tanggal)->addYears($retirementAge)->format('Y-m-d');
        } else {
            $retirementDate = null; // Jika TTL kosong, pensiun juga tidak bisa dihitung
        }

        // Ambil data tambahan
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $mapel = Mapel::all();
        $pendidikan = Pegawai::with('pendidikan')->find($id);
        $pekerjaan = Pegawai::with('pekerjaan')->find($id);
        $provinces = Province::all();
        $kabupaten = !empty($data->prov_id) ? Regency::where('province_id', $data->prov_id)->get() : [];
        $kecamatan = !empty($data->kab_id) ? District::where('regency_id', $data->kab_id)->get() : [];
        $desa = !empty($data->kec_id) ? Village::where('district_id', $data->kec_id)->get() : [];

        // Tambahkan tanggal keluar ke variabel $data untuk dikirim ke view
        $tgl_masuk = $data->tgl_masuk;
        $pensiun = $data->tgl_keluar = $retirementDate;

        return view('admin.pegawai.profile', compact(
            'data',
            'pendidikan',
            'pekerjaan',
            'mapel',
            'provinces',
            'kabupaten',
            'kecamatan',
            'desa',
            'pensiun',
            'tgl_masuk'
        ));
    }

    public function edit($id) // Menampilkan halaman edit
    {
        $pegawai = Pegawai::findOrFail($id);

        // Ambil data terkait lokasi berdasarkan data pegawai
        $provinces = Province::all();
        $kabupaten = !empty($pegawai->prov_id) ? Regency::where('province_id', $pegawai->prov_id)->get() : [];
        $kecamatan = !empty($pegawai->kab_id) ? District::where('regency_id', $pegawai->kab_id)->get() : [];
        $desa = !empty($pegawai->kec_id) ? Village::where('district_id', $pegawai->kec_id)->get() : [];

        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        $mapel = Mapel::all();
        $pendidikan = Pendidikan::all(); // Data pendidikan jika diperlukan
        $pekerjaan = Pekerjaan::all(); // Data pekerjaan jika diperlukan

        return view('admin.pegawai.edit', compact(
            'pegawai',
            'provinces',
            'kabupaten',
            'kecamatan',
            'desa',
            'jabatan',
            'golongan',
            'mapel',
            'pendidikan',
            'pekerjaan'
        ));
    }

    public function update(Request $request, $id)
    {
        // Cari pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        // Validasi data
        $validated = $request->validate([
            'nuptk' => 'required',
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'ttl' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
            'tgl_masuk' => 'required',
        ]);

        // Kalkulasi kemungkinan pensiun
        $retirementAge = 60;
        $ttl = $request->ttl; // Contoh: "Kudus, 2000-03-20"
        // Pisahkan string berdasarkan ", "
        list($tempat, $tanggal) = explode(', ', $ttl); // $tempat = "Kudus", $tanggal = "2000-03-20"
        // Parsing tanggal menggunakan Carbon
        $retirementDate = Carbon::parse($tanggal)->addYears($retirementAge)->format('Y-m-d');

        // Set tanggal masuk
        $tgl_masuk = $request->tgl_masuk ?: now()->format('Y-m-d');

        // Perbarui data pegawai
        $try = $pegawai->update([
            'nama_pegawai' => $request->nama_pegawai,
            'nuptk' => $request->nuptk,
            'nip' => $request->nip,
            'ttl' => $request->ttl,
            'jk' => $request->jk,
            'no_hp' => $request->no_hp,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $retirementDate,
            'jabatan_id' => $request->jabatan_id,
            'status_jabatan' => $request->status_jabatan,
            'golongan_id' => $request->golongan_id,
            'mapel_id' => $request->mapel_id,
        ]);

        // Perbarui pendidikan
        if ($request->has('pendidikan_masuk')) {
            $pegawai->pendidikan()->delete();

            foreach ($request->pendidikan_masuk as $index => $pendidikanMasuk) {
                $pegawai->pendidikan()->create([
                    'pendidikan_masuk' => $pendidikanMasuk,
                    'pendidikan_keluar' => $request->pendidikan_keluar[$index] ?? null,
                    'nama_sekolah' => $request->nama_sekolah[$index],
                    'pendidikan_jurusan' => $request->pendidikan_jurusan[$index] ?? null,
                ]);
            }
        }

        // Perbarui pekerjaan (opsional, jika dibutuhkan)
        if ($request->has('pekerjaan_masuk')) {
            $pegawai->pekerjaan()->delete();

            foreach ($request->pekerjaan_masuk as $index => $pekerjaanMasuk) {
                $pegawai->pekerjaan()->create([
                    'pekerjaan_masuk' => $pekerjaanMasuk,
                    'pekerjaan_keluar' => $request->pekerjaan_keluar[$index] ?? null,
                    'nama_perusahaan' => $request->nama_perusahaan[$index],
                    'posisi' => $request->posisi[$index],
                ]);
            }
        }

        return redirect()->route('pegawai.index')->with('edit', 'Data pegawai berhasil diperbarui.');
    }

    function formatTanggalIndo($tanggal)
    {
        if (!$tanggal) {
            return '-';
        }

        $bulanIndo = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        try {
            $dateObj = \Carbon\Carbon::parse($tanggal); // Parsing tanggal dengan Carbon
            $tanggalFormatted = $dateObj->format('d'); // Hari
            $bulanFormatted = $bulanIndo[(int)$dateObj->format('m')]; // Bulan dalam Bahasa Indonesia
            $tahunFormatted = $dateObj->format('Y'); // Tahun

            return "{$tanggalFormatted} {$bulanFormatted} {$tahunFormatted}";
        } catch (\Exception $e) {
            return '-'; // Jika parsing gagal, kembalikan tanda "-"
        }
    }


    public function getPegawaiByNip(Request $request) //mendapatkan data lengkap untuk kinerja
    {
        $nip = $request->query('nip');
        $pegawai = Pegawai::with(['jabatan', 'golongan'])->where('nip', $nip)->first();

        if ($pegawai) {
            return response()->json([
                'nama_pegawai' => $pegawai->nama_pegawai,
                'mapel' => $pegawai->jabatan->mapel ?? '',
            ]);
        }

        return response()->json(null, 404);
    }

    public function getkab(Request $request)
    {
        $prov_id = $request->prov_id;
        $regencies = Regency::where('province_id', $prov_id)->get();

        return response()->json($regencies);
    }

    public function getkec(Request $request)
    {
        $kab_id = $request->kab_id;
        $districts = District::where('regency_id', $kab_id)->get();

        return response()->json($districts);
    }

    public function getdesa(Request $request)
    {
        $kec_id = $request->kec_id;
        $villages = Village::where('district_id', $kec_id)->get();

        return response()->json($villages);
    }

    public function destroy($id)  //function hapus
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('error', 'Data pegawai tidak ditemukan.');
        }

        // Delete related data first (if applicable)
        $pegawai->pendidikan()->delete();
        $pegawai->pekerjaan()->delete();

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('hapus', 'Data pegawai berhasil dihapus.');
    }
}
