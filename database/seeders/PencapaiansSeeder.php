<?php

namespace Database\Seeders;

use App\Models\Pencapaian;
use Illuminate\Database\Seeder;

class PencapaiansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pencapaians = [
            [
                'metric' => 'Jumlah Siswa',
                'value' => '1200',
                'order_column' => 1,
            ],
            [
                'metric' => 'Jumlah Guru',
                'value' => '85',
                'order_column' => 2,
            ],
            [
                'metric' => 'Jumlah Jurusan',
                'value' => '5',
                'order_column' => 3,
            ],
            [
                'metric' => 'Luas Area Sekolah',
                'value' => '15.000 m²',
                'order_column' => 4,
            ],
            [
                'metric' => 'Tahun Berdiri',
                'value' => '1955',
                'order_column' => 5,
            ],
            [
                'metric' => 'Prestasi Akademik',
                'value' => '95% Lulus',
                'order_column' => 6,
            ],
            [
                'metric' => 'Fasilitas Modern',
                'value' => '25 Lab',
                'order_column' => 7,
            ],
            [
                'metric' => 'Program Ekstrakurikuler',
                'value' => '20 Jenis',
                'order_column' => 8,
            ],
        ];

        foreach ($pencapaians as $pencapaian) {
            Pencapaian::create($pencapaian);
        }
    }
}
