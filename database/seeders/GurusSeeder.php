<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'name' => 'Dr. Siti Aminah',
                'nip' => '198001011234567890',
                'subject' => 'Matematika',
                'email' => 'siti.aminah@sekolah.com',
                'phone' => '081234567898',
            ],
            [
                'name' => 'Bapak Ahmad Hidayat',
                'nip' => '198502021234567891',
                'subject' => 'Bahasa Indonesia',
                'email' => 'ahmad.hidayat@sekolah.com',
                'phone' => '081234567899',
            ],
            [
                'name' => 'Ibu Rina Sari',
                'nip' => '198703031234567892',
                'subject' => 'Bahasa Inggris',
                'email' => 'rina.sari@sekolah.com',
                'phone' => '081234567900',
            ],
            [
                'name' => 'Bapak Dedi Kurniawan',
                'nip' => '198804041234567893',
                'subject' => 'Fisika',
                'email' => 'dedi.kurniawan@sekolah.com',
                'phone' => '081234567901',
            ],
            [
                'name' => 'Ibu Maya Putri',
                'nip' => '198905051234567894',
                'subject' => 'Kimia',
                'email' => 'maya.putri@sekolah.com',
                'phone' => '081234567902',
            ],
            [
                'name' => 'Bapak Rizki Ramadhan',
                'nip' => '199006061234567895',
                'subject' => 'Biologi',
                'email' => 'rizki.ramadhan@sekolah.com',
                'phone' => '081234567903',
            ],
            [
                'name' => 'Ibu Sari Dewi',
                'nip' => '199107071234567896',
                'subject' => 'Sejarah',
                'email' => 'sari.dewi@sekolah.com',
                'phone' => '081234567904',
            ],
            [
                'name' => 'Bapak Fajar Setiawan',
                'nip' => '199208081234567897',
                'subject' => 'Teknologi Informasi',
                'email' => 'fajar.setiawan@sekolah.com',
                'phone' => '081234567905',
            ],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }
    }
}
