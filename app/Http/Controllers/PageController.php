<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fasilitas;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Siswa;

class PageController extends Controller
{
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('pages.about', compact('settings'));
    }

    public function facilities()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $fasilitas = Fasilitas::orderBy('name')->paginate(12);

        return view('pages.facilities', compact('settings', 'fasilitas'));
    }

    public function teachers()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $gurus = Guru::orderBy('name')->paginate(16);

        return view('pages.teachers', compact('settings', 'gurus'));
    }

    public function students()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $siswas = Siswa::with('jurusan')->orderBy('name')->paginate(20);

        return view('pages.students', compact('settings', 'siswas'));
    }

    public function news()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $posts = Post::with('author')->where('is_published', true)->orderBy('published_at', 'desc')->paginate(9);

        return view('pages.news', compact('settings', 'posts'));
    }

    public function events()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $events = Event::orderBy('event_date', 'desc')->paginate(12);

        return view('pages.events', compact('settings', 'events'));
    }

    public function majors()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $jurusans = Jurusan::withCount('siswas')->orderBy('name')->get();

        return view('pages.majors', compact('settings', 'jurusans'));
    }

    public function contact()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('pages.contact', compact('settings'));
    }
}
