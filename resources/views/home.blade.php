@extends('layouts.app')

@section('title', ($settings['school_name'] ?? 'Sekolah Indonesia') . ' - Profil Sekolah')

@section('content')
    <!-- Hero Section with Video Background & Enhanced CTA -->
    <section id="home" class="hero-section">
        @php
            $heroVideoUrl = $settings['hero_video_url'] ?? null;
            $featuredEvents = $events
                ->filter(function ($event) {
                    return $event->getFirstMediaUrl('images');
                })
                ->take(5);
        @endphp

        <!-- Video Background (Priority 1) -->
        @if ($heroVideoUrl)
            <video class="hero-video-background" autoplay muted loop playsinline>
                <source src="{{ $heroVideoUrl }}" type="video/mp4">
                <!-- Fallback to image if video fails -->
                <div class="hero-image-background" style="background-image: url('{{ asset('images/school-hero.jpg') }}');">
                </div>
            </video>

            <!-- Video Control Button -->
            <button class="video-control-btn" onclick="toggleVideoMute(this)" title="Toggle Sound">
                <i class="bi bi-volume-mute"></i>
            </button>
        @elseif($featuredEvents->count() > 0)
            <!-- Event Image Carousel (Priority 2) -->
            <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    @foreach ($featuredEvents as $index => $event)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="hero-carousel-item"
                                style="background-image: url('{{ $event->getFirstMediaUrl('images') }}');" role="img"
                                aria-label="Gambar acara sekolah: {{ $event->title }}"></div>
                        </div>
                    @endforeach
                </div>

                @if ($featuredEvents->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <div class="carousel-indicators">
                        @foreach ($featuredEvents as $index => $event)
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}"
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <!-- Default Image Background (Priority 3) -->
            <div class="hero-image-background" style="background-image: url('{{ asset('images/school-hero.jpg') }}');">
            </div>
        @endif

        <!-- Hero Overlay with Content -->
        <div class="hero-overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 hero-content">
                        <h1 class="mb-4 display-4 fw-bold">Selamat Datang
                            di<br><span class="text-warning">{{ $settings['school_name'] ?? 'Sekolah Indonesia' }}</span>
                        </h1>
                        <p class="mb-4 lead fs-5">
                            {{ $settings['school_description'] ?? 'Sekolah berkualitas dengan pendidikan terbaik untuk masa depan siswa.' }}
                        </p>

                        <!-- Enhanced CTA Buttons -->
                        <div class="hero-cta-buttons">
                            <a href="#tentang" class="px-4 py-3 mb-3 btn btn-primary btn-lg me-3">
                                <i class="bi bi-info-circle me-2"></i>Pelajari Lebih Lanjut
                            </a>
                            <a href="{{ route('contact') }}" class="px-4 py-3 mb-3 btn btn-outline-light btn-lg me-3">
                                <i class="bi bi-telephone me-2"></i>Hubungi Kami
                            </a>
                            <a href="#fasilitas" class="px-4 py-3 mb-3 btn btn-outline-light btn-lg">
                                <i class="bi bi-building me-2"></i>Lihat Fasilitas
                            </a>
                        </div>

                        <!-- Trust Signals -->
                        <div class="flex-wrap mt-4 d-flex justify-content-center">
                            <span class="px-3 py-2 mb-2 badge bg-light text-primary me-3">
                                <i class="bi bi-award me-1"></i>Terakreditasi A
                            </span>
                            <span class="px-3 py-2 mb-2 badge bg-light text-success me-3">
                                <i
                                    class="bi bi-mortarboard me-1"></i>{{ $pencapaians->where('metric', 'Jumlah Siswa')->first()->value ?? '500' }}
                                Siswa
                            </span>
                            <span class="px-3 py-2 mb-2 badge bg-light text-warning me-3">
                                <i class="bi bi-star me-1"></i>Sekolah Unggulan
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center row">
                @foreach ($pencapaians as $index => $pencapaian)
                    <div class="mb-4 col-md-3">
                        <div
                            class="border-0 shadow card h-100
                            @if ($index % 3 == 0) stats-card-primary
                            @elseif($index % 3 == 1) stats-card-secondary
                            @else stats-card-accent @endif">
                            <div class="p-4 card-body">
                                @if ($pencapaian->getFirstMediaUrl('icons'))
                                    <img src="{{ $pencapaian->getFirstMediaUrl('icons') }}"
                                        alt="{{ $pencapaian->metric }}"
                                        class="p-2 mb-3 bg-white achievement-icon rounded-circle">
                                @else
                                    <div
                                        class="mb-3 bg-white achievement-icon
                                        @if ($index % 3 == 0) achievement-icon-primary
                                        @elseif($index % 3 == 1) achievement-icon-secondary
                                        @else achievement-icon-accent @endif">
                                        <i class="bi bi-trophy fs-1"></i>
                                    </div>
                                @endif
                                <h2 class="mb-1 h1">{{ $pencapaian->value }}</h2>
                                <p class="mb-0">{{ $pencapaian->metric }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto text-center col-lg-8">
                    <h2 class="section-title">Tentang Kami</h2>
                    <p class="mb-4 lead">
                        {{ $settings['school_description'] ?? 'Sekolah berkualitas dengan pendidikan terbaik untuk masa depan siswa.' }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100 card-hover card-primary">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-eye text-primary-custom fs-1"></i>
                            <h5 class="card-title">Visi</h5>
                            <p class="card-text">
                                {{ $settings['school_vision'] ?? 'Mencetak generasi unggul yang berakhlak mulia dan berprestasi.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100 card-hover card-secondary">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-target text-secondary-custom fs-1"></i>
                            <h5 class="card-title">Misi</h5>
                            <p class="card-text">
                                {{ $settings['school_mission'] ?? 'Menyediakan pendidikan berkualitas dengan kurikulum modern dan tenaga pengajar profesional.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100 card-hover card-accent">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-clock-history text-accent-custom fs-1"></i>
                            <h5 class="card-title">Sejarah</h5>
                            <p class="card-text">
                                {{ $settings['school_history'] ?? 'Sekolah ini didirikan dengan tujuan memberikan pendidikan berkualitas sejak tahun 2000.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="fasilitas" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Fasilitas Sekolah</h2>
                    <p class="lead">Fasilitas modern untuk mendukung kegiatan belajar mengajar</p>
                </div>
            </div>
            <div class="row">
                @forelse($fasilitas->take(6) as $fasilitas)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <div class="border-0 shadow card h-100 card-hover facility-card">
                            @if ($fasilitas->getFirstMediaUrl('images'))
                                <img src="{{ $fasilitas->getFirstMediaUrl('images') }}" class="card-img-top"
                                    alt="{{ $fasilitas->name }}">
                            @else
                                <div class="text-white card-img-top bg-primary d-flex align-items-center justify-content-center"
                                    style="height: 200px;">
                                    <i class="bi bi-building fs-1"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $fasilitas->name }}</h5>
                                <p class="card-text">{{ Str::limit($fasilitas->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada data fasilitas yang ditambahkan.
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($fasilitas->count() > 6)
                <div class="mt-4 text-center">
                    <a href="{{ route('facilities') }}" class="btn btn-outline-primary">Lihat Semua Fasilitas</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Teachers Section -->
    <section id="guru" class="py-5">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Tenaga Pengajar</h2>
                    <p class="lead">Guru-guru profesional dan berkompeten</p>
                </div>
            </div>
            <div class="row">
                @forelse($gurus as $guru)
                    <div class="mb-4 col-md-6 col-lg-3">
                        <div class="text-center border-0 shadow card h-100 card-hover">
                            @if ($guru->getFirstMediaUrl('photos'))
                                <img src="{{ $guru->getFirstMediaUrl('photos') }}"
                                    class="mx-auto mt-3 card-img-top rounded-circle" alt="{{ $guru->name }}"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="mx-auto mt-3 text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 120px; height: 120px;">
                                    <i class="bi bi-person fs-1"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $guru->name }}</h6>
                                <p class="mb-1 text-primary">{{ $guru->subject }}</p>
                                <small class="text-muted">NIP: {{ $guru->nip }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada data guru yang ditambahkan.
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($gurus->count() > 8)
                <div class="mt-4 text-center">
                    <a href="{{ route('teachers') }}" class="btn btn-outline-primary">Lihat Semua Guru</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Students Section -->
    <section id="siswa" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Siswa Berprestasi Unggulan</h2>
                    <p class="lead">Para siswa berbakat yang telah mengharumkan nama sekolah di berbagai kompetisi</p>
                </div>
            </div>
            <div class="row">
                @php
                    $siswaBerprestasi = $siswas->filter(function ($siswa) {
                        return !empty($siswa->achievement_title);
                    });
                @endphp
                @forelse($siswaBerprestasi->take(8) as $siswa)
                    <div class="mb-4 col-md-6 col-lg-3">
                        <div class="text-center border-0 shadow card h-100 card-hover">
                            @if ($siswa->getFirstMediaUrl('photos'))
                                <img src="{{ $siswa->getFirstMediaUrl('photos') }}"
                                    class="mx-auto mt-3 card-img-top rounded-circle" alt="{{ $siswa->name }}"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="mx-auto mt-3 text-white bg-success rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 100px; height: 100px;">
                                    <i class="bi bi-person fs-2"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $siswa->name }}</h6>
                                <p class="mb-1 text-success">{{ $siswa->class }}</p>
                                @if ($siswa->jurusan)
                                    <small class="badge bg-primary">{{ $siswa->jurusan->name }}</small>
                                @endif
                                <small class="mt-2 text-muted d-block">NIS: {{ $siswa->nis }}</small>
                                @if ($siswa->achievement_title)
                                    <div class="mt-2">
                                        <small class="badge bg-warning text-dark">
                                            <i class="bi bi-trophy-fill me-1"></i>{{ ucfirst($siswa->achievement_level) }}
                                        </small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada data siswa yang ditambahkan.
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($siswas->count() > 8)
                <div class="mt-4 text-center">
                    <p class="mb-3 text-muted">Dan {{ $siswas->count() - 8 }} siswa lainnya...</p>
                    <a href="{{ route('students') }}" class="btn btn-outline-success">Lihat Semua Siswa</a>
                </div>
            @endif
        </div>
    </section>

    <!-- News Section -->
    <section id="berita" class="py-5">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Berita & Pengumuman</h2>
                    <p class="lead">Informasi terkini dari sekolah</p>
                </div>
            </div>
            <div class="row">
                @forelse($posts as $post)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
                            <div class="border-0 shadow card h-100 card-hover">
                                @if ($post->getFirstMediaUrl('cover'))
                                    <img src="{{ $post->getFirstMediaUrl('cover') }}" class="card-img-top"
                                        alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="text-white card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="bi bi-newspaper fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title text-dark">{{ $post->title }}</h6>
                                    <div class="card-text text-muted small">
                                        {!! Str::limit(strip_tags($post->body), 100) !!}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
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
                                </div>
                                <div class="bg-transparent border-0 card-footer">
                                    <small class="text-primary fw-medium">
                                        <i class="bi bi-arrow-right me-1"></i>Baca Selengkapnya
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada berita yang dipublikasikan.
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($posts->count() >= 6)
                <div class="mt-4 text-center">
                    <a href="{{ route('news') }}" class="btn btn-outline-primary">Lihat Semua Berita</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Kegiatan Sekolah</h2>
                    <p class="lead">Agenda dan kegiatan mendatang</p>
                </div>
            </div>
            <div class="row">
                @forelse($events->take(3) as $event)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <div class="border-0 shadow card h-100 card-hover">
                            @if ($event->getFirstMediaUrl('images'))
                                <img src="{{ $event->getFirstMediaUrl('images') }}" class="card-img-top"
                                    alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="text-white card-img-top bg-info d-flex align-items-center justify-content-center"
                                    style="height: 200px;">
                                    <i class="bi bi-calendar-event fs-1"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $event->title }}</h6>
                                <p class="card-text text-muted small">{{ Str::limit($event->description, 100) }}</p>
                                <div class="mb-2">
                                    <small class="text-primary d-block">
                                        <i
                                            class="bi bi-calendar me-1"></i>{{ $event->event_date ? $event->event_date->format('d/m/Y') : 'Tanggal belum ditentukan' }}
                                    </small>
                                    @if ($event->location)
                                        <small class="text-success d-block">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada kegiatan yang dijadwalkan.
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($events->count() > 3)
                <div class="mt-4 text-center">
                    <a href="{{ route('events') }}" class="btn btn-outline-info">Lihat Semua Kegiatan</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Majors Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Program Studi</h2>
                    <p class="lead">Pilihan jurusan untuk masa depan siswa</p>
                </div>
            </div>
            <div class="row">
                @forelse($jurusans as $jurusan)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <a href="{{ route('major.show', $jurusan->id) }}" class="text-decoration-none">
                            <div class="border-0 shadow card h-100 card-hover">
                                @if ($jurusan->getFirstMediaUrl('images'))
                                    <img src="{{ $jurusan->getFirstMediaUrl('images') }}" class="card-img-top"
                                        alt="{{ $jurusan->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="text-white card-img-top bg-warning d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="bi bi-mortarboard fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ $jurusan->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($jurusan->description, 120) }}</p>
                                    <div class="mt-3 d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">{{ $jurusan->siswas->count() }} Siswa</span>
                                        <small class="text-primary">
                                            <i class="bi bi-arrow-right me-1"></i>Lihat Detail
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada data jurusan yang ditambahkan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-5 bg-warm">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Hubungi Kami</h2>
                    <p class="lead">Kami siap membantu dan menjawab pertanyaan Anda</p>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-md-4">
                    <div class="text-center">
                        <i class="mb-3 bi bi-geo-alt text-primary-custom fs-1"></i>
                        <h5>Alamat</h5>
                        <p>{{ $settings['school_address'] ?? 'Alamat sekolah belum diatur' }}</p>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="text-center">
                        <i class="mb-3 bi bi-telephone text-secondary-custom fs-1"></i>
                        <h5>Telepon</h5>
                        <p>{{ $settings['school_phone'] ?? 'Telepon belum diatur' }}</p>
                        @if ($settings['school_phone'] ?? false)
                            <a href="tel:{{ $settings['school_phone'] }}" class="btn btn-secondary">Hubungi</a>
                        @endif
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="text-center">
                        <i class="mb-3 bi bi-envelope text-accent-custom fs-1"></i>
                        <h5>Email</h5>
                        <p>{{ $settings['school_email'] ?? 'Email belum diatur' }}</p>
                        @if ($settings['school_email'] ?? false)
                            <a href="mailto:{{ $settings['school_email'] }}" class="btn btn-accent">Kirim Email</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('contact') }}" class="btn btn-primary">Kontak Lengkap</a>
            </div>
        </div>
    </section>
@endsection
