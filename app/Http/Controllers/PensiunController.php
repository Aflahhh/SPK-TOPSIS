<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Pensiun;
use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PensiunController extends Controller
{
    public function index()
    {
      // Ambil semua data pegawai
      $pegawai = Pegawai::all();

      // Tambahkan informasi umur untuk setiap pegawai
      $pegawai = $pegawai->map(function ($item) {
          $item->umur = $this->hitungUmur($item->ttl); // Hitung umur
          return $item;
      });

      // Filter pegawai yang hampir 60 tahun (kurang dari 12 bulan menuju 60 tahun)
    $almost60 = $pegawai->filter(function ($item) {
        if ($item->ttl) {
            $ttl = explode(', ', $item->ttl); // Pisahkan tempat dan tanggal
            $tanggalLahir = Carbon::parse($ttl[1]); // Ambil tanggal lahir

            // Hitung ulang tahun ke-60
            $ulangTahun60 = $tanggalLahir->copy()->addYears(60);

            // Hitung bulan menuju ulang tahun ke-60
            $bulanMenuju60 = Carbon::now()->diffInMonths($ulangTahun60, false);

            // Filter pegawai yang kurang dari 12 bulan menuju ulang tahun ke-60
            return $bulanMenuju60 > 0 && $bulanMenuju60 <= 12;
        }
        return false;
    });

    // Kirim data ke view
    return view('admin.pensiun.index', [
        'pegawai' => $almost60
    ]);

    }


    public function hitungUmur($ttl)
    {
        if ($ttl) {
            // Pisahkan tempat dan tanggal dari ttl
            $data = explode(', ', $ttl);

            // Pastikan array memiliki elemen kedua (tanggal lahir)
            if (isset($data[1]) && Carbon::hasFormat($data[1], 'Y-m-d')) {
                $tanggalLahir = Carbon::parse($data[1]); // Parsing tanggal lahir

                // Hitung umur dan pastikan hasilnya integer (dibulatkan ke bawah)
                $umur = Carbon::now()->diffInYears($tanggalLahir);

                return $umur . ' tahun';
            }
        }

            return 'Tidak Valid'; // Jika TTL kosong atau format salah
    }


    public function fetchPegawai($nip)
    {
        $pegawai = Pegawai::where('nip', $nip)->first();

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'nama_pegawai' => $pegawai->nama_pegawai,
                'jabatan' => $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : null,
                'golongan' => $pegawai->golongan ? $pegawai->golongan->golongan : null,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Pegawai tidak ditemukan']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'pegawai_id' => [
                'required',
                Rule::exists('pegawai', 'id'), // Validasi bahwa pegawai_id ada di tabel Pegawai
            ],
            'jabatan_id' => 'required|exists:jabatan,id',
            'golongan_id' => 'required|exists:golongan,id',
            'tgl_pengajuan' => 'required|date',
            'tgl_pensiun' => 'required|date|after_or_equal:tgl_pengajuan',
        ]);

        Pensiun::create([
            'pegawai_id' => $request->pegawai_id,
            'jabatan_id' => $request->jabatan_id,
            'golongan_id' => $request->golongan_id,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'tgl_pensiun' => $request->tgl_pensiun,
        ]);

        return redirect()->route('pensiun.index')->with('success', 'Data Pensiun berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => [
                'required',
                Rule::exists('pegawai', 'id'),
            ],
            'jabatan_id' => 'required|exists:jabatan,id',
            'golongan_id' => 'required|exists:golongan,id',
            'tgl_pengajuan' => 'required|date',
            'tgl_pensiun' => 'required|date|after_or_equal:tgl_pengajuan',
        ]);

        $pensiun = Pensiun::findOrFail($id);

        $pensiun->update([
            'pegawai_id' => $request->pegawai_id,
            'jabatan_id' => $request->jabatan_id,
            'golongan_id' => $request->golongan_id,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'tgl_pensiun' => $request->tgl_pensiun,
        ]);

        return redirect()->route('pensiun.index')->with('success', 'Data Pensiun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pensiun = Pensiun::findOrFail($id);
        $pensiun->delete();

        return redirect()->route('pensiun.index')->with('success', 'Data Pensiun berhasil dihapus.');
    }
}
