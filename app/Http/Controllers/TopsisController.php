<?php 

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function calculateTopsis($nip)
    {
        // Ambil data penilaian dengan related nilai dan subkriteria
        $penilaian = Penilaian::with('nilai', 'kriteria.subkriteria')
                               ->where('nip', $nip)
                               ->first();

        // Jika penilaian ditemukan
        if ($penilaian) {
            // Buat Matriks Keputusan
            $matrix = $this->buildDecisionMatrix($penilaian);

            // Normalisasi Matriks
            $normMatrix = $this->normalizeMatrix($matrix);

            // Menentukan Bobot
            $weights = [0.2, 0.3, 0.5]; // Bobot contoh

            // Menghitung Matriks Terbobot
            $weightedMatrix = $this->calculateWeightedMatrix($normMatrix, $weights);

            // Menentukan Solusi Ideal Positif dan Negatif
            $idealPositive = $this->findIdealSolutionPositive($weightedMatrix);
            $idealNegative = $this->findIdealSolutionNegative($weightedMatrix);

            // Menghitung Jarak ke Solusi Ideal
            $distances = $this->calculateDistances($weightedMatrix, $idealPositive, $idealNegative);

            // Menghitung Preferensi Relatif
            $preference = $this->calculateRelativePreference($distances);

            return view('topsis_result', compact('preference'));
        }

        return redirect()->back()->with('error', 'Data penilaian tidak ditemukan.');
    }

    // Definisi Method Helper
    protected function buildDecisionMatrix($penilaian)
    {
        $matrix = [];
        foreach ($penilaian->kriteria as $kriteria) {
            foreach ($kriteria->subkriteria as $subkriteria) {
                $matrix[] = [
                    'subkriteria' => $subkriteria->nama_subkriteria,
                    'nilai' => $penilaian->nilai->where('subkriteria_id', $subkriteria->id)->first()->nilai
                ];
            }
        }
        return $matrix;
    }

    protected function normalizeMatrix($matrix)
    {
        $sumSquare = array_sum(array_map(function ($item) {
            return pow($item['nilai'], 2);
        }, $matrix));
        foreach ($matrix as $key => $row) {
            $matrix[$key]['nilai_normalisasi'] = $row['nilai'] / sqrt($sumSquare);
        }
        return $matrix;
    }

    protected function calculateWeightedMatrix($matrix, $weights)
    {
        foreach ($matrix as $index => $row) {
            $matrix[$index]['nilai_terbobot'] = $row['nilai_normalisasi'] * $weights[$index];
        }
        return $matrix;
    }

    protected function findIdealSolutionPositive($matrix)
    {
        return max(array_column($matrix, 'nilai_terbobot'));
    }

    protected function findIdealSolutionNegative($matrix)
    {
        return min(array_column($matrix, 'nilai_terbobot'));
    }

    protected function calculateDistances($matrix, $idealPositive, $idealNegative)
    {
        $distancePositive = array_map(function ($row) use ($idealPositive) {
            return pow($row['nilai_terbobot'] - $idealPositive, 2);
        }, $matrix);
        $distanceNegative = array_map(function ($row) use ($idealNegative) {
            return pow($row['nilai_terbobot'] - $idealNegative, 2);
        }, $matrix);

        $distancePositive = sqrt(array_sum($distancePositive));
        $distanceNegative = sqrt(array_sum($distanceNegative));

        return ['distancePositive' => $distancePositive, 'distanceNegative' => $distanceNegative];
    }

    protected function calculateRelativePreference($distances)
    {
        $D_plus = $distances['distancePositive'];
        $D_minus = $distances['distanceNegative'];
        return $D_minus / ($D_plus + $D_minus);
    }
}
