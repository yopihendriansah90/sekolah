<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            [
                'name' => 'Perpustakaan Modern',
                'description' => 'Perpustakaan dengan koleksi lebih dari 10.000 buku, dilengkapi dengan ruang baca digital dan akses internet cepat.',
            ],
            [
                'name' => 'Laboratorium Komputer',
                'description' => 'Lab komputer dengan 50 unit PC terbaru, dilengkapi software pengembangan dan desain grafis.',
            ],
            [
                'name' => 'Laboratorium Fisika',
                'description' => 'Fasilitas lengkap untuk praktikum fisika dengan peralatan modern dan ruang eksperimen yang aman.',
            ],
            [
                'name' => 'Laboratorium Kimia',
                'description' => 'Lab kimia dengan ventilasi modern dan peralatan analisis untuk pembelajaran praktis kimia.',
            ],
            [
                'name' => 'Laboratorium Biologi',
                'description' => 'Ruang praktikum biologi dengan mikroskop digital dan koleksi spesimen yang lengkap.',
            ],
            [
                'name' => 'Lapangan Olahraga',
                'description' => 'Lapangan multifungsi untuk sepak bola, basket, dan voli dengan tribun penonton.',
            ],
            [
                'name' => 'Aula Serbaguna',
                'description' => 'Aula berkapasitas 500 orang untuk kegiatan akademik, seni, dan pertemuan besar.',
            ],
            [
                'name' => 'Kantin Sehat',
                'description' => 'Kantin dengan menu sehat dan bergizi, diawasi oleh ahli gizi sekolah.',
            ],
            [
                'name' => 'Mushola',
                'description' => 'Ruang ibadah yang nyaman dan bersih untuk siswa muslim dengan fasilitas wudu.',
            ],
            [
                'name' => 'Klinik Kesehatan',
                'description' => 'Klinik sekolah dengan tenaga medis profesional untuk pelayanan kesehatan siswa.',
            ],
        ];

        foreach ($fasilitas as $fasilita) {
            Fasilitas::create($fasilita);
        }
    }
}
