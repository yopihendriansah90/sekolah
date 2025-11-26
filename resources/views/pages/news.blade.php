@extends('layouts.app')

@section('title', 'Berita & Pengumuman - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-section"
        style="background: linear-gradient(135deg, #FF6B6B 0%, #ee5a24 100%); color: white; padding: 100px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Berita & Pengumuman</h1>
                    <p class="mb-4 lead">Informasi terkini dan pengumuman penting dari sekolah</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- News Grid -->
    <section class="py-5">
        <div class="container">
            @if ($posts->count() > 0)
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="mb-4 col-md-6 col-lg-4">
                            <div class="border-0 shadow card h-100 card-hover">
                                @if ($post->getFirstMediaUrl('images'))
                                    <img src="{{ $post->getFirstMediaUrl('images') }}" class="card-img-top"
                                        alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="text-white card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="bi bi-newspaper fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $post->title }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit(strip_tags($post->body), 120) }}</p>
                                    <div class="mt-3 d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i
                                                class="bi bi-calendar me-1"></i>{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}
                                        </small>
                                        @if ($post->author)
                                            <small class="text-primary">
                                                <i class="bi bi-person me-1"></i>{{ $post->author->name }}
                                            </small>
                                        @endif
                                    </div>
                                    @if ($post->category)
                                        <div class="mt-2">
                                            <span class="badge bg-primary">{{ $post->category }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-newspaper fs-1 text-muted"></i>
                            <h4 class="text-muted">Belum ada berita</h4>
                            <p class="text-muted">Berita dan pengumuman akan segera dipublikasikan di sini.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- News Stats -->
    @if ($posts->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center row">
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-primary">{{ $posts->total() }}</h2>
                                <p class="mb-0 text-muted">Total Berita</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-success">
                                    {{ $posts->where('published_at', '>=', now()->startOfMonth())->count() }}</h2>
                                <p class="mb-0 text-muted">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-info">
                                    {{ $posts->where('author_id', '!=', null)->unique('author_id')->count() }}</h2>
                                <p class="mb-0 text-muted">Penulis</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-warning">
                                    {{ $posts->where('category', '!=', null)->unique('category')->count() }}</h2>
                                <p class="mb-0 text-muted">Kategori</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Newsletter Signup -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto text-center col-lg-8">
                    <h2 class="mb-4">Dapatkan Update Terbaru</h2>
                    <p class="mb-4 lead">Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang kegiatan
                        sekolah</p>
                    <div class="border-0 shadow card">
                        <div class="p-4 card-body">
                            <form class="row g-3">
                                <div class="col-md-8">
                                    <input type="email" class="form-control form-control-lg"
                                        placeholder="Masukkan email Anda" required>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Berlangganan</button>
                                </div>
                            </form>
                            <small class="mt-2 text-muted d-block">Kami menghargai privasi Anda dan tidak akan spam email
                                Anda.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-white bg-primary">
        <div class="container text-center">
            <h2 class="mb-4">Ingin Tahu Lebih Banyak?</h2>
            <p class="mb-4 lead">Jelajahi aspek lain dari sekolah kami</p>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <a href="{{ route('about') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-info-circle me-2"></i>Tentang Kami
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('facilities') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-building me-2"></i>Fasilitas
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('events') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-calendar-event me-2"></i>Kegiatan
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
