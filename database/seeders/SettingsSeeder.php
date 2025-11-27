<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'school_name', 'value' => 'SMK 1 CIAMIS'],
            ['key' => 'school_address', 'value' => 'Jl. Nasional II, Sindangkasih, Ciamis'],
            ['key' => 'school_phone', 'value' => '+62 21 1234 5678'],
            ['key' => 'school_email', 'value' => 'info@smk1ciamis.sch.id'],
            ['key' => 'school_website', 'value' => 'https://smk1ciamis.sch.id'],
            ['key' => 'school_description', 'value' => 'SMK 1 Ciamis adalah sekolah menengah atas unggulan yang berkomitmen memberikan pendidikan berkualitas tinggi dengan kurikulum modern dan tenaga pengajar profesional.'],
            ['key' => 'school_vision', 'value' => 'Menjadi sekolah unggulan yang mencetak generasi muda yang berakhlak mulia, berprestasi akademik, dan siap menghadapi tantangan global.'],
            ['key' => 'school_mission', 'value' => 'Menyelenggarakan pendidikan yang berkualitas, mengembangkan potensi siswa secara holistik, menumbuhkan kreativitas dan inovasi, serta membangun karakter yang kuat.'],
            ['key' => 'school_history', 'value' => 'Didirikan pada tahun 1985, SMK 1 Ciamis telah berkembang menjadi salah satu sekolah terkemuka di Indonesia dengan berbagai prestasi akademik dan non-akademik.'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/smk1ciamis'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/smk1ciamis'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/smk1ciamis'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
