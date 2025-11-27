@extends('layouts.app')

@section('title', $post->title . ' - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">{{ $post->title }}</h1>
                    <div class="mb-4">
                        @if ($post->category)
                            <span class="px-3 py-2 badge bg-primary fs-6 me-2">
                                <i class="bi bi-tag me-1"></i>{{ $post->category }}
                            </span>
                        @endif
                        @if ($post->is_published)
                            <span class="px-3 py-2 badge bg-success fs-6">
                                <i class="bi bi-check-circle me-1"></i>Diterbitkan
                            </span>
                        @else
                            <span class="px-3 py-2 badge bg-warning fs-6">
                                <i class="bi bi-clock me-1"></i>Draft
                            </span>
                        @endif
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('news') }}"
                                    class="text-white text-decoration-none">Berita</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">
                                {{ Str::limit($post->title, 30) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-8">
                    <!-- Featured Image -->
                    @if ($post->getFirstMediaUrl('cover'))
                        <div class="mb-4 text-center">
                            <img src="{{ $post->getFirstMediaUrl('cover') }}" class="rounded shadow img-fluid"
                                alt="{{ $post->title }}" style="max-height: 500px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Post Meta -->
                    <div class="pb-3 mb-4 d-flex justify-content-between align-items-center border-bottom">
                        <div class="d-flex align-items-center">
                            @if ($post->author)
                                <div class="me-3">
                                    <i class="bi bi-person-circle text-primary fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Penulis</small>
                                    <strong>{{ $post->author->name }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Diterbitkan</small>
                            <strong>{{ $post->published_at ? $post->published_at->format('d M Y, H:i') : $post->created_at->format('d M Y, H:i') }}</strong>
                        </div>
                    </div>

                    <!-- Post Body -->
                    <div class="mb-5 post-content">
                        {!! nl2br(e($post->body)) !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="pt-4 mb-4 border-top">
                        <h5 class="mb-3">Bagikan Artikel Ini</h5>
                        <div class="gap-2 d-flex">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                                class="btn btn-outline-primary">
                                <i class="bi bi-facebook me-1"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($post->title) }}"
                                target="_blank" class="btn btn-outline-info">
                                <i class="bi bi-twitter me-1"></i>Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . url()->current()) }}"
                                target="_blank" class="btn btn-outline-success">
                                <i class="bi bi-whatsapp me-1"></i>WhatsApp
                            </a>
                            <button
                                onclick="navigator.share({title: '{{ $post->title }}', url: '{{ url()->current() }}'})"
                                class="btn btn-outline-secondary">
                                <i class="bi bi-share me-1"></i>Bagikan
                            </button>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="pt-4 d-flex justify-content-between border-top">
                        <a href="{{ route('news') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Berita
                        </a>
                        <div>
                            @if ($previousPost = \App\Models\Post::where('is_published', true)->where('id', '<', $post->id)->orderBy('id', 'desc')->first())
                                <a href="{{ route('posts.show', $previousPost->slug) }}"
                                    class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-chevron-left me-1"></i>Sebelumnya
                                </a>
                            @endif
                            @if ($nextPost = \App\Models\Post::where('is_published', true)->where('id', '>', $post->id)->orderBy('id', 'asc')->first())
                                <a href="{{ route('posts.show', $nextPost->slug) }}" class="btn btn-outline-secondary">
                                    Selanjutnya<i class="bi bi-chevron-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @php
        $relatedPosts = \App\Models\Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
    @endphp

    @if ($relatedPosts->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <div class="mb-5 text-center">
                    <h2 class="section-title">Berita Terkait</h2>
                    <p class="text-muted">Artikel lain yang mungkin Anda minati</p>
                </div>

                <div class="row">
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="mb-4 col-md-4">
                            <div class="border-0 shadow card h-100 card-hover">
                                @if ($relatedPost->getFirstMediaUrl('cover'))
                                    <img src="{{ $relatedPost->getFirstMediaUrl('cover') }}" class="card-img-top"
                                        alt="{{ $relatedPost->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="text-white card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="bi bi-newspaper fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ Str::limit($relatedPost->title, 50) }}</h6>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit(strip_tags($relatedPost->body), 80) }}</p>
                                    <div class="mt-3 d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            {{ $relatedPost->published_at ? $relatedPost->published_at->format('d/m/Y') : $relatedPost->created_at->format('d/m/Y') }}
                                        </small>
                                        @if ($relatedPost->category)
                                            <span class="badge bg-primary">{{ $relatedPost->category }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-transparent border-0 card-footer">
                                    <a href="{{ route('posts.show', $relatedPost->slug) }}" class="btn btn-primary w-100">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
