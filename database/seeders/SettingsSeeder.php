<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'school_name', 'value' => 'SMA Negeri 1 Indonesia'],
            ['key' => 'school_address', 'value' => 'Jl. Pendidikan No. 123, Jakarta Pusat, DKI Jakarta 10110'],
            ['key' => 'school_phone', 'value' => '+62 21 1234 5678'],
            ['key' => 'school_email', 'value' => 'info@sman1-indonesia.sch.id'],
            ['key' => 'school_website', 'value' => 'https://sman1-indonesia.sch.id'],
            ['key' => 'school_description', 'value' => 'SMA Negeri 1 Indonesia adalah sekolah menengah atas unggulan yang berkomitmen memberikan pendidikan berkualitas tinggi dengan kurikulum modern dan tenaga pengajar profesional.'],
            ['key' => 'school_vision', 'value' => 'Menjadi sekolah unggulan yang mencetak generasi muda yang berakhlak mulia, berprestasi akademik, dan siap menghadapi tantangan global.'],
            ['key' => 'school_mission', 'value' => 'Menyelenggarakan pendidikan yang berkualitas, mengembangkan potensi siswa secara holistik, menumbuhkan kreativitas dan inovasi, serta membangun karakter yang kuat.'],
            ['key' => 'school_history', 'value' => 'Didirikan pada tahun 1985, SMA Negeri 1 Indonesia telah berkembang menjadi salah satu sekolah terkemuka di Indonesia dengan berbagai prestasi akademik dan non-akademik.'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/sman1indonesia'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/sman1indonesia'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/sman1indonesia'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
