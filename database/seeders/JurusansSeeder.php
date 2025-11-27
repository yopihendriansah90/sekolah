<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'name' => 'Teknik Informatika',
                'description' => 'Jurusan yang mempelajari tentang teknologi informasi, pemrograman, dan pengembangan perangkat lunak.',
            ],
            [
                'name' => 'Teknik Mesin',
                'description' => 'Jurusan yang fokus pada desain, produksi, dan perawatan mesin serta sistem mekanik.',
            ],
            [
                'name' => 'Teknik Elektro',
                'description' => 'Jurusan yang membahas tentang sistem kelistrikan, elektronika, dan kontrol otomatis.',
            ],
            [
                'name' => 'Administrasi Bisnis',
                'description' => 'Jurusan yang mengajarkan tentang manajemen bisnis, akuntansi, dan administrasi perusahaan.',
            ],
            [
                'name' => 'Bahasa Inggris',
                'description' => 'Jurusan yang mendalami bahasa Inggris, sastra, dan komunikasi internasional.',
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
