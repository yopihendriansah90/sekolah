<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            [
                'name' => 'Ahmad Rahman',
                'nis' => '2024001',
                'class' => 'XII',
                'jurusan_id' => 1,
                'email' => 'ahmad.rahman@sekolah.com',
                'phone' => '081234567890',
                'achievement_title' => 'Juara 1 Lomba Programming',
                'achievement_description' => 'Memenangkan lomba programming tingkat kabupaten dengan proyek aplikasi web.',
                'competition_name' => 'Lomba Programming Kabupaten',
                'achievement_level' => 'kabupaten',
                'achievement_year' => 2024,
                'achievement_category' => 'teknologi',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'nis' => '2024002',
                'class' => 'XI',
                'jurusan_id' => 2,
                'email' => 'siti.nurhaliza@sekolah.com',
                'phone' => '081234567891',
                'achievement_title' => null,
                'achievement_description' => null,
                'competition_name' => null,
                'achievement_level' => null,
                'achievement_year' => null,
                'achievement_category' => null,
            ],
            [
                'name' => 'Budi Santoso',
                'nis' => '2024003',
                'class' => 'XII',
                'jurusan_id' => 3,
                'email' => 'budi.santoso@sekolah.com',
                'phone' => '081234567892',
                'achievement_title' => 'Juara 2 Olimpiade Fisika',
                'achievement_description' => 'Memperoleh medali perak dalam olimpiade fisika tingkat provinsi.',
                'competition_name' => 'Olimpiade Fisika Provinsi',
                'achievement_level' => 'provinsi',
                'achievement_year' => 2023,
                'achievement_category' => 'sains',
            ],
            [
                'name' => 'Maya Sari',
                'nis' => '2024004',
                'class' => 'X',
                'jurusan_id' => 4,
                'email' => 'maya.sari@sekolah.com',
                'phone' => '081234567893',
                'achievement_title' => null,
                'achievement_description' => null,
                'competition_name' => null,
                'achievement_level' => null,
                'achievement_year' => null,
                'achievement_category' => null,
            ],
            [
                'name' => 'Rizki Pratama',
                'nis' => '2024005',
                'class' => 'XI',
                'jurusan_id' => 5,
                'email' => 'rizki.pratama@sekolah.com',
                'phone' => '081234567894',
                'achievement_title' => 'Juara 1 Lomba Bahasa Inggris',
                'achievement_description' => 'Memenangkan lomba pidato bahasa Inggris tingkat sekolah.',
                'competition_name' => 'Lomba Pidato Bahasa Inggris',
                'achievement_level' => 'sekolah',
                'achievement_year' => 2024,
                'achievement_category' => 'bahasa',
            ],
            [
                'name' => 'Dewi Lestari',
                'nis' => '2024006',
                'class' => 'XII',
                'jurusan_id' => 1,
                'email' => 'dewi.lestari@sekolah.com',
                'phone' => '081234567895',
                'achievement_title' => null,
                'achievement_description' => null,
                'competition_name' => null,
                'achievement_level' => null,
                'achievement_year' => null,
                'achievement_category' => null,
            ],
            [
                'name' => 'Fajar Nugroho',
                'nis' => '2024007',
                'class' => 'X',
                'jurusan_id' => 2,
                'email' => 'fajar.nugroho@sekolah.com',
                'phone' => '081234567896',
                'achievement_title' => 'Juara 3 Lomba Robotik',
                'achievement_description' => 'Memperoleh juara 3 dalam kompetisi robotik tingkat nasional.',
                'competition_name' => 'Kompetisi Robotik Nasional',
                'achievement_level' => 'nasional',
                'achievement_year' => 2024,
                'achievement_category' => 'teknologi',
            ],
            [
                'name' => 'Indah Permata',
                'nis' => '2024008',
                'class' => 'XI',
                'jurusan_id' => 3,
                'email' => 'indah.permata@sekolah.com',
                'phone' => '081234567897',
                'achievement_title' => null,
                'achievement_description' => null,
                'competition_name' => null,
                'achievement_level' => null,
                'achievement_year' => null,
                'achievement_category' => null,
            ],
        ];

        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }
    }
}
