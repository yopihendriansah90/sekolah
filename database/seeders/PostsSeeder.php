<?php

namespace Database\Seeders;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Selamat Datang di Website Sekolah Kami',
                'slug' => 'selamat-datang-website-sekolah',
                'body' => '<p>Kami dengan bangga mempersembahkan website resmi <strong>Sekolah Menengah Atas Negeri 1 Jakarta</strong>. Website ini dibuat untuk memberikan informasi terkini tentang kegiatan sekolah, prestasi siswa, dan berbagai program pendidikan yang kami tawarkan.</p><p>Melalui website ini, siswa, orang tua, dan masyarakat dapat mengakses berbagai informasi penting dengan mudah dan cepat. <em>Fitur-fitur unggulan</em> meliputi:</p><ul><li>Berita dan pengumuman terkini</li><li>Informasi prestasi siswa</li><li>Galeri kegiatan sekolah</li><li>Informasi fasilitas dan program studi</li></ul>',
                'category' => 'Berita Sekolah',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
                'author_id' => 1,
            ],
            [
                'title' => 'Pengumuman Libur Semester Ganjil 2024/2025',
                'slug' => 'pengumuman-libur-semester-ganjil',
                'body' => 'Diberitahukan kepada seluruh siswa, guru, dan karyawan bahwa libur semester ganjil tahun ajaran 2024/2025 akan dimulai pada tanggal 20 Desember 2024 hingga 5 Januari 2025. Selama masa libur, kantor administrasi akan tetap beroperasi dengan jadwal terbatas. Kami mengingatkan untuk menggunakan waktu libur ini sebaik mungkin untuk beristirahat dan mempersiapkan diri menghadapi semester genap.',
                'category' => 'Pengumuman',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
                'author_id' => 1,
            ],
            [
                'title' => 'Prestasi Siswa dalam Lomba Sains Nasional',
                'slug' => 'prestasi-siswa-lomba-sains-nasional',
                'body' => 'Tim siswa SMA Negeri 1 Jakarta berhasil meraih juara 2 dalam Lomba Sains Nasional yang diselenggarakan oleh Kementerian Pendidikan dan Kebudayaan. Tim yang terdiri dari 5 siswa kelas XII ini berhasil mengalahkan ratusan tim dari seluruh Indonesia dengan proyek inovasi teknologi ramah lingkungan. Kepala sekolah menyampaikan apresiasi atas dedikasi dan kerja keras siswa serta guru pembimbing.',
                'category' => 'Kegiatan Siswa',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
                'author_id' => 1,
            ],
            [
                'title' => 'Tips Belajar Efektif di Era Digital',
                'slug' => 'tips-belajar-efektif-era-digital',
                'body' => '<p>Dalam era digital saat ini, siswa memiliki akses yang luas terhadap berbagai sumber belajar. Namun, penting untuk tetap fokus dan menggunakan waktu dengan bijak.</p><blockquote class="blockquote"><p>"Belajar adalah proses seumur hidup yang tidak pernah berakhir."</p></blockquote><p>Artikel ini akan membahas berbagai <strong>tips dan strategi belajar efektif</strong> yang dapat membantu siswa mencapai prestasi akademik yang optimal. Mulai dari:</p><ol><li><strong>Manajemen waktu</strong> yang efektif</li><li><em>Teknik membaca cepat</em> dan efisien</li><li>Penggunaan aplikasi pendidikan yang tepat</li><li>Teknik konsentrasi dan fokus</li></ol><p>Dengan menerapkan tips ini, siswa dapat meningkatkan produktivitas belajar mereka secara signifikan.</p><figure data-trix-attachment="{"contentType":"image/png","filename":"study-tips.png","filesize":245760,"height":600,"href":"http://127.0.0.1:8000/storage/study-tips.png","url":"http://127.0.0.1:8000/storage/study-tips.png","width":800}" data-trix-content-type="image/png" data-trix-attributes="{"presentation":"gallery"}" class="attachment attachment--preview attachment--png"><a href="http://127.0.0.1:8000/storage/study-tips.png"><img src="http://127.0.0.1:8000/storage/study-tips.png" width="800" height="600"><figcaption class="attachment__caption"><span class="attachment__name">study-tips.png</span> <span class="attachment__size">240 KB</span></figcaption></a></figure><p>Gambar di atas menunjukkan berbagai teknik belajar yang efektif yang telah terbukti berhasil diterapkan oleh siswa-siswa berprestasi di sekolah kami.</p>',
                'category' => 'Artikel Edukasi',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'author_id' => 1,
            ],
            [
                'title' => 'Draf: Rencana Kegiatan Tahun 2025',
                'slug' => 'draf-rencana-kegiatan-2025',
                'body' => 'Dokumen ini berisi rencana kegiatan sekolah untuk tahun 2025. Akan diupdate dengan informasi lebih detail setelah rapat koordinasi dengan seluruh stakeholder sekolah.',
                'category' => 'Pengumuman',
                'is_published' => false,
                'published_at' => null,
                'author_id' => 1,
            ],
        ];

        foreach ($posts as $index => $postData) {
            $post = Post::create($postData);

            // Add sample cover images for published posts
            if ($post->is_published) {
                $imageUrls = [
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1544717297-fa95b6ee9643?w=800&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop',
                ];

                // Add a cover image to each published post
                if (isset($imageUrls[$index])) {
                    $post->addMediaFromUrl($imageUrls[$index])
                        ->usingName('Cover image for '.$post->title)
                        ->usingFileName('cover-'.$post->slug.'.jpg')
                        ->toMediaCollection('cover');
                }
            }
        }
    }
}
