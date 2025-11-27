<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'name' => 'Berita Sekolah',
                'slug' => 'berita-sekolah',
                'description' => 'Berita dan informasi terkini tentang kegiatan sekolah.',
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'description' => 'Pengumuman penting dari pihak sekolah kepada siswa dan orang tua.',
            ],
            [
                'name' => 'Kegiatan Siswa',
                'slug' => 'kegiatan-siswa',
                'description' => 'Informasi tentang kegiatan ekstrakurikuler dan prestasi siswa.',
            ],
            [
                'name' => 'Artikel Edukasi',
                'slug' => 'artikel-edukasi',
                'description' => 'Artikel dan tips edukasi untuk siswa dan orang tua.',
            ],
            [
                'name' => 'Galeri',
                'slug' => 'galeri',
                'description' => 'Koleksi foto dan video kegiatan sekolah.',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
