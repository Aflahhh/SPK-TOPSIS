<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\mapel;
use App\Models\jabatan;
use App\Models\pegawai;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\golongan;
use App\Models\Province;
use App\Models\pekerjaan;
use App\Models\pendidikan;
use Illuminate\Http\Request;
use App\Models\StatusJabatan;
use Illuminate\Http\JsonResponse;
use App\Models\PendidikanTerakhir;

class PegawaiController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua data pegawai
        $pegawai = Pegawai::all();
    
        // // Filter pegawai yang hampir 60 tahun (kurang dari 12 bulan menuju 60 tahun)
        // $almost60 = $pegawai->filter(function ($item) {
        //     if ($item->ttl) {
        //         $ttl = explode(', ', $item->ttl); // Pisahkan tempat dan tanggal
        //         $tanggalLahir = Carbon::parse($ttl[1]); // Ambil tanggal lahir
    
        //         // Hitung ulang tahun ke-60
        //         $ulangTahun60 = $tanggalLahir->copy()->addYears(60);
    
        //         // Hitung bulan menuju ulang tahun ke-60
        //         $bulanMenuju60 = Carbon::now()->diffInMonths($ulangTahun60, false);
    
        //         // Filter pegawai yang kurang dari 12 bulan menuju ulang tahun ke-60
        //         return $bulanMenuju60 > 0 && $bulanMenuju60 <= 12;
        //     }
        //     return false;
        // });
    
        // // Filter pegawai berdasarkan status_jabatan_id == 2 dan umur >= 56
        // $pensiun = $pegawai->filter(function ($item) {
        //     if ($item->ttl && $item->status_jabatan_id == 2) {
        //         $ttl = explode(', ', $item->ttl); // Pisahkan tempat dan tanggal
        //         $tanggalLahir = Carbon::parse($ttl[1]); // Ambil tanggal lahir
    
        //         // Hitung umur berdasarkan tahun saja
        //         $umur = Carbon::now()->year - $tanggalLahir->year;
    
        //         // Filter jika umur >= 56
        //         return $umur >= 56;
        //     }
        //     return false;
        // });
    
        // // Filter pegawai yang usianya tidak hampir 60 tahun
        // $notAlmost60 = $pegawai->diff($almost60)->diff($pensiun);
    
        // // Tentukan data yang akan ditampilkan berdasarkan filter
        // $filter = $request->get('filter', 'notAlmost60'); 
        // if ($filter === 'notAlmost60') {
        //     $filteredPegawai = $notAlmost60;
        // } elseif ($filter === 'almost60') {
        //     $filteredPegawai = $almost60;
        // } elseif ($filter === 'pensiun') {
        //     $filteredPegawai = $pensiun;
        // }
    
        return view('admin.pegawai.index', [
            'pegawai' => $pegawai,
            // 'filteredPegawai' => $filteredPegawai,
            // 'almost60Count' => $almost60->count(), // Jumlah pegawai hampir 60 tahun
            // 'notAlmost60Count' => $notAlmost60->count(), // Jumlah pegawai tidak hampir 60 tahun
            // 'pensiunCount' => $pensiun->count(), // Jumlah pegawai status_jabatan_id == 2 dan umur >= 56
        ]);
    }
    

    public function addData()
    {  // menampilkan halaman tambah data pegawai
        $pegawai = Pegawai::all();
        $jabatan = Jabatan::all();
        $status_jabatan = StatusJabatan::all();
        $golongan = Golongan::all();
        $mapel = Mapel::all();
        $provinces = Province::all();

        return view('admin.pegawai.tambah', compact(
            'pegawai',
            'jabatan',
            'golongan',
            'mapel',
            'provinces',
            'status_jabatan'
        ));
    }

    public function create(Request $request)
{
    $validator = $request->validate([

        // data pegawai
        'nuptk' => 'required',
        'nama_pegawai' => 'required',
        'nbm' => 'required',
        'alamat' => 'required',
        'ttl' => 'required',
        'jk' => 'required',
        'no_hp' => 'required',
        'pendidikan_terakhir' => 'required',
        'jurusan' => 'required',
        'status_perkawinan' => 'required',

        // jabatan dan golongan
        'jabatan_id' => 'required',
        'status_jabatan_id' => 'required',
        'golongan_id' => 'required',
        'mapel_id' => 'required',

        // sertifikasi
        'tahun_sertifikasi' => 'nullable|date',
        'tempat_sertifikasi' => 'nullable|string',
        'mengajar_sekolah_lain' => 'required|in:Ya,Tidak',
        'sekolah_lain' => 'nullable|required_if:mengajar_sekolah_lain,Ya|string',
    ]);

    $pegawai = new Pegawai();

    // Set data pegawai 
    $pegawai->nuptk = $validator['nuptk'];
    $pegawai->nama_pegawai = $validator['nama_pegawai'];
    $pegawai->nbm = $validator['nbm'];
    $pegawai->alamat = $validator['alamat'];
    $pegawai->ttl = $validator['ttl'];
    $pegawai->jk = $validator['jk'];
    $pegawai->no_hp = $validator['no_hp'];
    $pegawai->pendidikan_terakhir = $validator['pendidikan_terakhir'];
    $pegawai->jurusan = $validator['jurusan'];
    $pegawai->status_perkawinan = $validator['status_perkawinan'];

    // Kalkulasi kemungkinan pensiun
    $retirementAge = 60;
    list($tempat, $tanggal) = explode(', ', $validator['ttl']); // Pisahkan "Tempat, Tanggal"
    $retirementDate = Carbon::parse($tanggal)->addYears($retirementAge)->format('Y-m-d'); // Hitung pensiun
    $pegawai->tgl_purna = $retirementDate;

    // Jabatan dan golongan
    $pegawai->jabatan_id = $validator['jabatan_id'];
    $pegawai->status_jabatan_id = $validator['status_jabatan_id'];
    $pegawai->golongan_id = $validator['golongan_id'];
    $pegawai->mapel_id = $validator['mapel_id'];

    // Sertifikasi
    $pegawai->tahun_sertifikasi = $validator['tahun_sertifikasi'] ?? null;
    $pegawai->tempat_sertifikasi = $validator['tempat_sertifikasi'] ?? "-";
    $pegawai->mengajar_sekolah_lain = $validator['mengajar_sekolah_lain'];
    $pegawai->sekolah_lain = $validator['mengajar_sekolah_lain'] === 'Ya' ? $validator['sekolah_lain'] : "-";

    
    // Simpan pegawai
    $pegawai->save();

    return redirect()->route('pegawai.index', ['filter' => 'notAlmost60'])->with('tambah', 'Data Berhasil Ditambahkan');
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
        $pekerjaan = Pegawai::with('pekerjaan')->find($id);
        $status_jabatan = StatusJabatan::all();
        $provinces = Province::all();
        $kabupaten = !empty($data->prov_id) ? Regency::where('province_id', $data->prov_id)->get() : [];
        $kecamatan = !empty($data->kab_id) ? District::where('regency_id', $data->kab_id)->get() : [];
        $desa = !empty($data->kec_id) ? Village::where('district_id', $data->kec_id)->get() : [];

        // Tambahkan tanggal keluar ke variabel $data untuk dikirim ke view
        $tgl_masuk = $data->tgl_masuk;
        $pensiun = $data->tgl_keluar = $retirementDate;

        return view('admin.pegawai.profile', compact(
            'data',
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
        $jabatan = Jabatan::all();
        $status_jabatan = StatusJabatan::all();
        $golongan = Golongan::all();
        $mapel = Mapel::all();
        $pekerjaan = Pekerjaan::all(); // Data pekerjaan jika diperlukan

        return view('admin.pegawai.edit', compact(
            'pegawai',
            'jabatan',
            'golongan',
            'mapel',
            'pekerjaan',
            'status_jabatan'
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
            'nbm' => 'required',
            'alamat' => 'required',
            'ttl' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
            'pendidikan_terakhir' => 'required',
            'jurusan' => 'required',
            'status_perkawinan' => 'required',
    
            // jabatan dan golongan
            'jabatan_id' => 'required',
            'status_jabatan_id' => 'required',
            'golongan_id' => 'required',
            'mapel_id' => 'required',
    
            // sertifikasi
            'tahun_sertifikasi' => 'nullable|date',
            'tempat_sertifikasi' => 'nullable|string',
            'mengajar_sekolah_lain' => 'required|in:Ya,Tidak',
            'sekolah_lain' => 'nullable|required_if:mengajar_sekolah_lain,Ya|string',
        ]);
    
        
        // Kalkulasi kemungkinan pensiun
        $retirementAge = 60;
        list($tempat, $tanggal) = explode(', ', $validated['ttl']); // Pisahkan "Tempat, Tanggal"
        $retirementDate = Carbon::parse($tanggal)->addYears($retirementAge)->format('Y-m-d'); // Hitung pensiun
    
        // Perbarui data pegawai
        $pegawai->update([
            'tgl_purna' => $retirementDate,
            'nama_pegawai' => $validated['nama_pegawai'],
            'nuptk' => $validated['nuptk'],
            'nbm' => $validated['nbm'],
            'alamat' => $validated['alamat'],
            'ttl' => $validated['ttl'],
            'jk' => $validated['jk'],
            'no_hp' => $validated['no_hp'],
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
            'jurusan' => $validated['jurusan'],
            'status_perkawinan' => $validated['status_perkawinan'],
    
            // Jabatan dan golongan
            'jabatan_id' => $validated['jabatan_id'],
            'status_jabatan_id' => $validated['status_jabatan_id'],
            'golongan_id' => $validated['golongan_id'],
            'mapel_id' => $validated['mapel_id'],
    
            // Sertifikasi
            'tahun_sertifikasi' => $validated['tahun_sertifikasi'] ?? null,
            'tempat_sertifikasi' => $validated['tempat_sertifikasi'] ?? "-",
            'mengajar_sekolah_lain' => $validated['mengajar_sekolah_lain'],
            'sekolah_lain' => $validated['mengajar_sekolah_lain'] === 'Ya' ? $validated['sekolah_lain'] : "-",
        ]);

        // dd($retirementDate);
    
        return redirect()->route('pegawai.index', ['filter' => 'notAlmost60'])
            ->with('edit', 'Data pegawai berhasil diperbarui.');
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
        $nbm = $request->query('nbm');
        $pegawai = Pegawai::with(['jabatan', 'golongan'])->where('nbm', $nbm)->first();

        if ($pegawai) {
            return response()->json([
                'nama_pegawai' => $pegawai->nama_pegawai,
                'mapel' => $pegawai->jabatan->mapel ?? '',
            ]);
        }

        return response()->json(null, 404);
    }
    
    public function getNotifications(): JsonResponse
{
    $pegawai = Pegawai::with('jabatan')->get();

    // Filter pegawai berdasarkan kriteria umur dan jabatan
    $hampirPensiun = $pegawai->filter(function ($pegawai) {
        if (isset($pegawai->ttl)) {
            list($tempat, $tanggal) = explode(', ', $pegawai->ttl);
            $birthYear = Carbon::parse($tanggal)->year; // Ambil hanya tahun lahir
            $currentYear = Carbon::now()->year; // Ambil tahun saat ini
            $umur = $currentYear - $birthYear; // Hitung umur berdasarkan tahun saja

            // Jabatan ID = 2: Hampir pensiun jika tahun ini umur 59 (1 tahun lagi 60)
            if ($pegawai->jabatan_id == 2) {
                return $umur >= 56;
            } else {

                return $umur >= 59;
            }

            // Jabatan lain: Hampir pensiun jika tahun ini umur 56 (1 tahun lagi 57)
        }

        return false;
    });

    // Format data untuk response
    $details = $hampirPensiun->map(function ($pegawai) {
        return [
            'nama_pegawai' => $pegawai->nama_pegawai,
            'jabatan' => $pegawai->jabatan->nama_jabatan,
        ];  
    });

    return response()->json([
        'count' => $hampirPensiun->count(),
        'details' => $details,
    ]);
}



    // public function getkab(Request $request)
    // {
    //     $prov_id = $request->prov_id;
    //     $regencies = Regency::where('province_id', $prov_id)->get();

    //     return response()->json($regencies);
    // }

    // public function getkec(Request $request)
    // {
    //     $kab_id = $request->kab_id;
    //     $districts = District::where('regency_id', $kab_id)->get();

    //     return response()->json($districts);
    // }   

    // public function getdesa(Request $request)
    // {
    //     $kec_id = $request->kec_id;
    //     $villages = Village::where('district_id', $kec_id)->get();

    //     return response()->json($villages);
    // }

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

        return redirect()->route('pegawai.index', ['filter' => 'notAlmost60'])->with('hapus', 'Data pegawai berhasil dihapus.');
    }

    

}
