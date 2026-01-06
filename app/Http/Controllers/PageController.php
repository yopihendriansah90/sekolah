<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fasilitas;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function showTeacher(Guru $guru)
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('pages.teacher-detail', compact('settings', 'guru'));
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

    public function showPost(Post $post)
    {
        // Only show published posts
        if (! $post->is_published) {
            abort(404);
        }

        $settings = Setting::pluck('value', 'key')->toArray();
        $previousPost = Post::where('is_published', true)
            ->where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->first();
        $nextPost = Post::where('is_published', true)
            ->where('id', '>', $post->id)
            ->orderBy('id', 'asc')
            ->first();
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('posts.show', compact('settings', 'post', 'previousPost', 'nextPost', 'relatedPosts'));
    }

    public function search(Request $request)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $query = $request->get('q', '');

        $results = collect();

        if (! empty($query)) {
            // Search in Posts
            $posts = Post::where('is_published', true)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('body', 'LIKE', "%{$query}%")
                        ->orWhere('category', 'LIKE', "%{$query}%");
                })
                ->with('author')
                ->get()
                ->map(function ($post) {
                    // Process content for search preview
                    $content = $post->body;

                    // Remove Trix attachments from search preview to avoid broken HTML
                    $content = preg_replace('/<figure[^>]*data-trix-attachment[^>]*>.*?<\/figure>/s', '', $content);
                    $content = preg_replace('/<img[^>]*src[^>]*>/s', '', $content);

                    if (strlen(strip_tags($content)) > 150) {
                        // Try to find a good breaking point
                        $plainText = strip_tags($content);
                        $truncatedText = Str::limit($plainText, 150);

                        // If we have HTML, try to preserve structure up to similar length
                        if (strlen($content) > strlen($plainText)) {
                            // Find position in plain text and map back to HTML
                            $breakPos = strlen($truncatedText) - 3; // Account for "..."
                            $htmlPos = 0;
                            $plainPos = 0;

                            while ($htmlPos < strlen($content) && $plainPos < $breakPos) {
                                if ($content[$htmlPos] === '<') {
                                    // Skip HTML tags
                                    while ($htmlPos < strlen($content) && $content[$htmlPos] !== '>') {
                                        $htmlPos++;
                                    }
                                    $htmlPos++; // Skip the >
                                } else {
                                    $plainPos++;
                                    $htmlPos++;
                                }
                            }

                            // Find the end of current tag or word
                            while ($htmlPos < strlen($content) && ! in_array($content[$htmlPos], [' ', '>', '</'])) {
                                $htmlPos++;
                            }

                            $content = substr($content, 0, $htmlPos).'...';
                        } else {
                            $content = $truncatedText;
                        }
                    }

                    return (object) [
                        'id' => $post->id,
                        'title' => $post->title,
                        'content' => $content,
                        'type' => 'Berita',
                        'url' => route('posts.show', $post->slug),
                        'image' => $post->getFirstMediaUrl('cover'),
                        'date' => $post->published_at ?? $post->created_at,
                        'category' => $post->category,
                        'author' => $post->author?->name,
                    ];
                });

            // Search in Events
            $events = Event::where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhere('location', 'LIKE', "%{$query}%");
            })
                ->get()
                ->map(function ($event) {
                    return (object) [
                        'id' => $event->id,
                        'title' => $event->title,
                        'content' => Str::limit(strip_tags($event->description), 150),
                        'type' => 'Kegiatan',
                        'url' => route('events'),
                        'image' => $event->getFirstMediaUrl('images'),
                        'date' => $event->event_date,
                        'category' => 'Event',
                        'author' => null,
                    ];
                });

            // Search in Siswa (Students)
            $siswas = Siswa::with('jurusan')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('class', 'LIKE', "%{$query}%")
                        ->orWhereHas('jurusan', function ($jq) use ($query) {
                            $jq->where('name', 'LIKE', "%{$query}%");
                        });
                })
                ->get()
                ->map(function ($siswa) {
                    $jurusanName = $siswa->jurusan ? $siswa->jurusan->name : 'N/A';

                    return (object) [
                        'id' => $siswa->id,
                        'title' => $siswa->name,
                        'content' => "Kelas {$siswa->class} - {$jurusanName} | NIS: {$siswa->nis}",
                        'type' => 'Siswa',
                        'url' => route('students'),
                        'image' => $siswa->getFirstMediaUrl('photos'),
                        'date' => null,
                        'category' => 'Student',
                        'author' => null,
                    ];
                });

            // Search in Guru (Teachers)
            $gurus = Guru::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('subject', 'LIKE', "%{$query}%");
            })
                ->get()
                ->map(function ($guru) {
                    return (object) [
                        'id' => $guru->id,
                        'title' => $guru->name,
                        'content' => "Mata Pelajaran: {$guru->subject} | NIP: {$guru->nip}",
                        'type' => 'Guru',
                        'url' => route('teachers'),
                        'image' => $guru->getFirstMediaUrl('photos'),
                        'date' => null,
                        'category' => 'Teacher',
                        'author' => null,
                    ];
                });

            // Search in Fasilitas (Facilities)
            $fasilitas = Fasilitas::where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%");
            })
                ->get()
                ->map(function ($fasilita) {
                    return (object) [
                        'id' => $fasilita->id,
                        'title' => $fasilita->name,
                        'content' => Str::limit(strip_tags($fasilita->description), 150),
                        'type' => 'Fasilitas',
                        'url' => route('facilities'),
                        'image' => $fasilita->getFirstMediaUrl('images'),
                        'date' => null,
                        'category' => 'Facility',
                        'author' => null,
                    ];
                });

            // Combine all results
            $results = collect([
                ...$posts,
                ...$events,
                ...$siswas,
                ...$gurus,
                ...$fasilitas,
            ]);
        }

        return view('search.results', compact('settings', 'query', 'results'));
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

    public function showMajor(Jurusan $jurusan)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $siswas = $jurusan->siswas()->with('jurusan')->paginate(12);
        $gurus = Guru::where('subject', 'LIKE', '%'.$jurusan->name.'%')->get();

        return view('pages.major-detail', compact('settings', 'jurusan', 'siswas', 'gurus'));
    }

    public function contact()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('pages.contact', compact('settings'));
    }
}
