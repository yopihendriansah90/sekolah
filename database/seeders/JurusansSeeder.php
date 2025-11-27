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
                'description' => 'Jurusan Teknik Informatika mempelajari tentang teknologi informasi, pemrograman, pengembangan perangkat lunak, basis data, jaringan komputer, dan kecerdasan buatan. Siswa akan dibekali dengan keterampilan praktis dalam pengembangan aplikasi web dan mobile, serta pemahaman mendalam tentang teknologi digital masa kini. Prospek karir meliputi software developer, web developer, data analyst, system administrator, dan entrepreneur teknologi.',
            ],
            [
                'name' => 'Teknik Mesin',
                'description' => 'Jurusan Teknik Mesin fokus pada desain, produksi, dan perawatan mesin serta sistem mekanik. Siswa akan mempelajari tentang mekanika teknik, termodinamika, desain mesin, manufaktur, dan otomasi industri. Program ini memberikan pemahaman komprehensif tentang teknologi manufaktur modern dan persiapan karir di industri manufaktur, otomotif, energi, dan konstruksi. Lulusan siap menjadi engineer mesin, teknisi industri, dan manajer produksi.',
            ],
            [
                'name' => 'Teknik Elektro',
                'description' => 'Jurusan Teknik Elektro membahas tentang sistem kelistrikan, elektronika, kontrol otomatis, dan sistem tenaga. Siswa akan mempelajari tentang rangkaian listrik, elektronika daya, sistem kontrol, telekomunikasi, dan renewable energy. Program ini menyiapkan siswa untuk karir di industri kelistrikan, elektronika konsumen, telekomunikasi, dan energi terbarukan. Lulusan dapat bekerja sebagai engineer elektro, teknisi elektronika, dan spesialis sistem kontrol.',
            ],
            [
                'name' => 'Administrasi Bisnis',
                'description' => 'Jurusan Administrasi Bisnis mengajarkan tentang manajemen bisnis, akuntansi, pemasaran, keuangan, dan administrasi perusahaan. Siswa akan mempelajari keterampilan manajerial, analisis bisnis, dan etika bisnis yang diperlukan untuk berkarir di dunia bisnis. Program ini mencakup mata pelajaran seperti manajemen sumber daya manusia, pemasaran digital, akuntansi keuangan, dan entrepreneurship. Prospek karir meliputi manajer bisnis, akuntan, marketing specialist, dan wirausahawan.',
            ],
            [
                'name' => 'Bahasa Inggris',
                'description' => 'Jurusan Bahasa Inggris mendalami bahasa Inggris, sastra, komunikasi internasional, dan linguistik. Siswa akan mengembangkan kemampuan berbahasa Inggris yang tinggi melalui pembelajaran intensif speaking, writing, reading, dan listening. Program ini juga mencakup studi budaya, terjemahan, dan komunikasi bisnis internasional. Lulusan siap berkarir sebagai translator, interpreter, English teacher, content writer, tour guide, dan profesional di bidang hospitality dan pariwisata internasional.',
            ],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
