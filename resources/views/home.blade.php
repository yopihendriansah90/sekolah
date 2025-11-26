@extends('layouts.app')

@section('title', ($settings['school_name'] ?? 'Sekolah Indonesia') . ' - Profil Sekolah')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-4 display-4 fw-bold">Selamat Datang
                        di<br>{{ $settings['school_name'] ?? 'Sekolah Indonesia' }}</h1>
                    <p class="mb-4 lead">
                        {{ $settings['school_description'] ?? 'Sekolah berkualitas dengan pendidikan terbaik untuk masa depan siswa.' }}
                    </p>
                    <a href="#tentang" class="btn btn-light btn-lg me-3">Pelajari Lebih Lanjut</a>
                    <a href="#kontak" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/school-hero.jpg') }}" alt="Sekolah" class="rounded shadow img-fluid"
                        onerror="this.src='https://via.placeholder.com/600x400/667eea/white?text=Sekolah'">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center row">
                @foreach ($pencapaians as $pencapaian)
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow card stats-card h-100">
                            <div class="p-4 card-body">
                                @if ($pencapaian->getFirstMediaUrl('icons'))
                                    <img src="{{ $pencapaian->getFirstMediaUrl('icons') }}" alt="{{ $pencapaian->metric }}"
                                        class="p-2 mb-3 bg-white achievement-icon rounded-circle">
                                @else
                                    <div class="mb-3 bg-white achievement-icon text-primary">
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
                    <div class="border-0 shadow card h-100 card-hover">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-eye text-primary fs-1"></i>
                            <h5 class="card-title">Visi</h5>
                            <p class="card-text">
                                {{ $settings['school_vision'] ?? 'Mencetak generasi unggul yang berakhlak mulia dan berprestasi.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100 card-hover">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-target text-success fs-1"></i>
                            <h5 class="card-title">Misi</h5>
                            <p class="card-text">
                                {{ $settings['school_mission'] ?? 'Menyediakan pendidikan berkualitas dengan kurikulum modern dan tenaga pengajar profesional.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100 card-hover">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-clock-history text-info fs-1"></i>
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
                @forelse($fasilitas as $fasilitas)
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
                                <div class="mt-2">
                                    @if ($guru->email)
                                        <a href="mailto:{{ $guru->email }}" class="text-decoration-none me-2">
                                            <i class="bi bi-envelope text-primary"></i>
                                        </a>
                                    @endif
                                    @if ($guru->phone)
                                        <a href="tel:{{ $guru->phone }}" class="text-decoration-none">
                                            <i class="bi bi-telephone text-success"></i>
                                        </a>
                                    @endif
                                </div>
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
        </div>
    </section>

    <!-- Students Section -->
    <section id="siswa" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Siswa Berprestasi</h2>
                    <p class="lead">Para siswa yang telah menunjukkan prestasi akademik dan non-akademik</p>
                </div>
            </div>
            <div class="row">
                @forelse($siswas->take(8) as $siswa)
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
                    <p class="text-muted">Dan {{ $siswas->count() - 8 }} siswa lainnya...</p>
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
                                <h6 class="card-title">{{ $post->title }}</h6>
                                <p class="card-text text-muted small">{{ Str::limit(strip_tags($post->body), 100) }}</p>
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
                        </div>
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
                                <h5 class="card-title">{{ $jurusan->name }}</h5>
                                <p class="card-text">{{ Str::limit($jurusan->description, 120) }}</p>
                                <div class="mt-3">
                                    <span class="badge bg-primary">{{ $jurusan->siswas->count() }} Siswa</span>
                                </div>
                            </div>
                        </div>
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
    <section id="kontak" class="py-5 text-white bg-primary">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="text-white section-title">Hubungi Kami</h2>
                    <p class="lead">Kami siap membantu dan menjawab pertanyaan Anda</p>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-md-4">
                    <div class="text-center">
                        <i class="mb-3 bi bi-geo-alt fs-1"></i>
                        <h5>Alamat</h5>
                        <p>{{ $settings['school_address'] ?? 'Alamat sekolah belum diatur' }}</p>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="text-center">
                        <i class="mb-3 bi bi-telephone fs-1"></i>
                        <h5>Telepon</h5>
                        <p>{{ $settings['school_phone'] ?? 'Telepon belum diatur' }}</p>
                        @if ($settings['school_phone'] ?? false)
                            <a href="tel:{{ $settings['school_phone'] }}" class="btn btn-light">Hubungi</a>
                        @endif
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="text-center">
                        <i class="mb-3 bi bi-envelope fs-1"></i>
                        <h5>Email</h5>
                        <p>{{ $settings['school_email'] ?? 'Email belum diatur' }}</p>
                        @if ($settings['school_email'] ?? false)
                            <a href="mailto:{{ $settings['school_email'] }}" class="btn btn-light">Kirim Email</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
