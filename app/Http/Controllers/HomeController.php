<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fasilitas;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Pencapaian;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Siswa;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch settings as key-value pairs
        $settings = Setting::pluck('value', 'key')->toArray();

        // Fetch data from all models
        $data = [
            'settings' => $settings,
            'gurus' => Guru::orderBy('name')->get(),
            'siswas' => Siswa::with('jurusan')->orderBy('name')->get(),
            'jurusans' => Jurusan::orderBy('name')->get(),
            'fasilitas' => Fasilitas::orderBy('name')->get(),
            'events' => Event::orderBy('event_date', 'desc')->get(),
            'pencapaians' => Pencapaian::orderBy('order_column')->get(),
            'posts' => Post::with('author')->where('is_published', true)->orderBy('published_at', 'desc')->limit(6)->get(),
        ];

        return view('home', $data);
    }
}
