<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Peringatan Hari Kemerdekaan RI',
                'description' => 'Upacara peringatan hari kemerdekaan Republik Indonesia ke-79. Seluruh siswa dan guru diwajibkan mengikuti upacara bendera yang akan dilaksanakan di lapangan sekolah.',
                'event_date' => '2024-08-17',
                'location' => 'Lapangan Sekolah',
            ],
            [
                'title' => 'Pentas Seni Siswa',
                'description' => 'Pentas seni tahunan yang menampilkan berbagai pertunjukan dari siswa-siswi SMA Negeri 1 Jakarta. Acara ini akan menampilkan tarian, musik, dan drama yang telah dipersiapkan selama beberapa bulan.',
                'event_date' => '2024-12-15',
                'location' => 'Aula Sekolah',
            ],
            [
                'title' => 'Workshop Teknologi Informasi',
                'description' => 'Workshop intensif tentang pengembangan aplikasi mobile dan web. Para peserta akan belajar dari praktisi IT profesional dan mendapatkan sertifikat kompetensi.',
                'event_date' => '2025-01-20',
                'location' => 'Laboratorium Komputer',
            ],
            [
                'title' => 'Lomba Olahraga Siswa',
                'description' => 'Kompetisi olahraga antar kelas yang meliputi cabang sepak bola, basket, dan voli. Acara ini bertujuan untuk meningkatkan semangat sportivitas dan kebugaran siswa.',
                'event_date' => '2025-02-10',
                'location' => 'Lapangan Olahraga',
            ],
            [
                'title' => 'Kunjungan Industri ke PT. Teknologi Maju',
                'description' => 'Kunjungan studi ke perusahaan teknologi terkemuka untuk memberikan wawasan praktis kepada siswa jurusan Teknik Informatika tentang dunia kerja.',
                'event_date' => '2025-03-05',
                'location' => 'PT. Teknologi Maju, Jakarta',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
