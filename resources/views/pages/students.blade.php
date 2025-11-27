@extends('layouts.app')

@section('title', 'Siswa Berprestasi - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="overflow-hidden hero-primary position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-10">
                    <div class="mb-4">
                        <i class="mb-3 bi bi-trophy-fill fs-1 text-warning"></i>
                    </div>
                    <h1 class="mb-4 display-4 fw-bold">Siswa Berprestasi Unggulan</h1>
                    <p class="mb-4 lead fs-5">Bukti komitmen sekolah dalam mencetak generasi emas yang siap bersaing di
                        tingkat nasional dan internasional</p>
                    <div class="mb-4">
                        <span class="px-4 py-2 badge bg-warning text-dark fs-6 me-2">
                            <i class="bi bi-star-fill me-1"></i>Prestasi Tingkat Nasional
                        </span>
                        <span class="px-4 py-2 text-white badge bg-success fs-6 me-2">
                            <i class="bi bi-award-fill me-1"></i>Juara Kompetisi
                        </span>
                        <span class="px-4 py-2 text-white badge bg-info fs-6">
                            <i class="bi bi-lightning-fill me-1"></i>Talenta Unggulan
                        </span>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Siswa Berprestasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div class="opacity-25 position-absolute top-50 start-0 translate-middle-y">
            <i class="bi bi-trophy fs-1 text-warning"></i>
        </div>
        <div class="opacity-25 position-absolute top-25 end-0">
            <i class="bi bi-star fs-2 text-warning"></i>
        </div>
        <div class="opacity-25 position-absolute bottom-25 start-25">
            <i class="bi bi-award fs-3 text-warning"></i>
        </div>
    </section>

    <!-- Success Story Section -->
    <section class="py-5 text-white bg-gradient-primary">
        <div class="container">
            <div class="mb-5 text-center">
                <h2 class="mb-3 fw-bold">Kisah Sukses Siswa Kami</h2>
                <p class="mb-4 lead">Setiap prestasi adalah hasil dari dedikasi, kerja keras, dan bimbingan yang berkualitas
                </p>
            </div>
            <div class="text-center row">
                <div class="mb-4 col-md-3">
                    <div class="mb-3">
                        <i class="bi bi-graph-up-arrow fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $siswas->where('achievement_title', '!=', null)->count() }}</h3>
                    <p class="mb-0">Siswa Berprestasi</p>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="mb-3">
                        <i class="bi bi-trophy-fill fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold text-warning">
                        {{ $siswas->where('achievement_level', 'nasional')->count() + $siswas->where('achievement_level', 'internasional')->count() }}
                    </h3>
                    <p class="mb-0">Tingkat Nasional</p>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="mb-3">
                        <i class="bi bi-star-fill fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $siswas->unique('achievement_category')->count() }}</h3>
                    <p class="mb-0">Kategori Prestasi</p>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="mb-3">
                        <i class="bi bi-calendar-check-fill fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ now()->year - 2020 }}</h3>
                    <p class="mb-0">Tahun Berkarya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Achievements -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="mb-5 text-center">
                <h2 class="section-title">Prestasi Unggulan Siswa Kami</h2>
                <p class="lead text-muted">Para siswa berbakat yang telah mengharumkan nama sekolah di berbagai kompetisi
                </p>
            </div>

            @if ($siswas->where('achievement_title', '!=', null)->count() > 0)
                <div class="row">
                    @foreach ($siswas->where('achievement_title', '!=', null)->take(6) as $siswa)
                        <div class="mb-4 col-md-6 col-lg-4">
                            <div class="overflow-hidden border-0 shadow-lg card h-100 position-relative">
                                <!-- Achievement Badge -->
                                <div class="top-0 position-absolute end-0 z-index-1">
                                    <span
                                        class="badge fs-6 px-3 py-2 bg-{{ $siswa->achievement_level == 'sekolah' ? 'secondary' : ($siswa->achievement_level == 'kabupaten' ? 'info' : ($siswa->achievement_level == 'provinsi' ? 'warning' : ($siswa->achievement_level == 'nasional' ? 'success' : 'primary'))) }} text-white">
                                        <i class="bi bi-trophy-fill me-1"></i>{{ ucfirst($siswa->achievement_level) }}
                                    </span>
                                </div>

                                @if ($siswa->getFirstMediaUrl('photos'))
                                    <img src="{{ $siswa->getFirstMediaUrl('photos') }}" class="card-img-top"
                                        alt="{{ $siswa->name }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="text-white bg-gradient-primary d-flex align-items-center justify-content-center"
                                        style="height: 250px;">
                                        <i class="bi bi-person-circle fs-1"></i>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <h5 class="mb-1 card-title fw-bold text-primary">{{ $siswa->name }}</h5>
                                    <p class="mb-2 text-muted">{{ $siswa->class }} - {{ $siswa->jurusan->name ?? 'N/A' }}
                                    </p>

                                    <div class="p-3 mb-3 rounded bg-success bg-opacity-10">
                                        <h6 class="mb-2 text-success fw-bold">
                                            <i class="bi bi-award-fill me-1"></i>{{ $siswa->achievement_title }}
                                        </h6>
                                        <p class="mb-2 small text-dark">{{ $siswa->achievement_description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt-fill me-1"></i>{{ $siswa->competition_name }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar-event me-1"></i>{{ $siswa->achievement_year }}
                                            </small>
                                        </div>
                                        <div class="mt-2">
                                            <span
                                                class="badge bg-light text-dark">{{ ucfirst($siswa->achievement_category) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-transparent border-0 card-footer">
                                    <div class="text-center">
                                        @if ($siswa->email)
                                            <a href="mailto:{{ $siswa->email }}"
                                                class="btn btn-outline-primary btn-sm me-2">
                                                <i class="bi bi-envelope me-1"></i>Kontak
                                            </a>
                                        @endif
                                        @if ($siswa->phone)
                                            <a href="tel:{{ $siswa->phone }}" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-telephone me-1"></i>Telepon
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-trophy fs-1 text-warning"></i>
                            <h4 class="text-muted">Prestasi Menanti</h4>
                            <p class="text-muted">Para siswa berbakat kami sedang mempersiapkan diri untuk berbagai
                                kompetisi.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Achievement Showcase -->
    @php
        $siswaBerprestasi = $siswas->filter(function ($siswa) {
            return !empty($siswa->achievement_title);
        });
    @endphp

    @if ($siswaBerprestasi->count() > 0)
        <section class="py-5">
            <div class="container">
                <div class="mb-5 text-center">
                    <h2 class="section-title">Galeri Prestasi</h2>
                    <p class="lead text-muted">Koleksi pencapaian siswa dalam berbagai bidang</p>
                </div>

                <div class="row">
                    @foreach ($siswaBerprestasi as $siswa)
                        <div class="mb-4 col-md-6 col-lg-4">
                            <div class="border-0 shadow card h-100 card-hover">
                                @if ($siswa->getFirstMediaUrl('photos'))
                                    <img src="{{ $siswa->getFirstMediaUrl('photos') }}" class="card-img-top"
                                        alt="{{ $siswa->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="text-white bg-primary d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="bi bi-person fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $siswa->name }}</h6>
                                    <p class="mb-1 text-primary">{{ $siswa->class }} -
                                        {{ $siswa->jurusan->name ?? 'N/A' }}</p>

                                    <div class="p-3 border rounded bg-warning bg-opacity-10 border-warning">
                                        <h6 class="mb-2 text-warning fw-bold">
                                            <i class="bi bi-star-fill me-1"></i>{{ $siswa->achievement_title }}
                                        </h6>
                                        <p class="mb-1 small">{{ $siswa->achievement_description }}</p>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">{{ $siswa->competition_name }}</small>
                                            <small
                                                class="badge bg-warning text-dark">{{ $siswa->achievement_year }}</small>
                                        </div>
                                        <div class="mt-2">
                                            <span
                                                class="badge bg-{{ $siswa->achievement_level == 'sekolah' ? 'secondary' : ($siswa->achievement_level == 'kabupaten' ? 'info' : ($siswa->achievement_level == 'provinsi' ? 'warning' : ($siswa->achievement_level == 'nasional' ? 'success' : 'primary'))) }}">
                                                {{ ucfirst($siswa->achievement_level) }}
                                            </span>
                                            <span
                                                class="badge bg-light text-dark ms-1">{{ ucfirst($siswa->achievement_category) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-transparent border-0 card-footer">
                                    <div class="text-center">
                                        @if ($siswa->email)
                                            <a href="mailto:{{ $siswa->email }}"
                                                class="btn btn-outline-primary btn-sm me-2">
                                                <i class="bi bi-envelope me-1"></i>Kontak
                                            </a>
                                        @endif
                                        @if ($siswa->phone)
                                            <a href="tel:{{ $siswa->phone }}" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-telephone me-1"></i>Telepon
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($siswaBerprestasi->count() > 12)
                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $siswas->links() }}
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Achievement Stats Section -->
    @if ($siswas->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center row">
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-primary-custom">{{ $siswas->total() }}</h2>
                                <p class="mb-0 text-muted">Total Siswa</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-success">{{ $siswas->where('achievement_title', '!=', null)->count() }}
                                </h2>
                                <p class="mb-0 text-muted">Siswa Berprestasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-warning">
                                    {{ $siswas->where('achievement_level', 'provinsi')->count() + $siswas->where('achievement_level', 'nasional')->count() + $siswas->where('achievement_level', 'internasional')->count() }}
                                </h2>
                                <p class="mb-0 text-muted">Tingkat Tinggi</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-info">{{ $siswas->unique('jurusan.name')->count() }}</h2>
                                <p class="mb-0 text-muted">Jurusan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Achievement Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="text-center section-title">Kategori Prestasi</h2>
                    <div class="row">
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-trophy text-warning fs-1"></i>
                                <h5>Akademik</h5>
                                <p>Prestasi dalam bidang akademik dan pengetahuan.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-bicycle text-success fs-1"></i>
                                <h5>Olahraga</h5>
                                <p>Prestasi dalam berbagai cabang olahraga.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-palette text-primary fs-1"></i>
                                <h5>Seni</h5>
                                <p>Prestasi dalam bidang seni dan budaya.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-cpu text-info fs-1"></i>
                                <h5>Teknologi</h5>
                                <p>Prestasi dalam bidang teknologi dan inovasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-white bg-gradient-primary">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold">Bergabunglah dengan Kami!</h2>
            <p class="mb-4 lead fs-5">Jadilah bagian dari generasi pemenang berikutnya</p>
            <div class="mb-4 row justify-content-center">
                <div class="col-lg-8">
                    <div class="p-4 mb-4 text-white bg-opacity-75 border border-opacity-50 bg-dark rounded-3 border-info">
                        <h4 class="mb-3 text-info fw-bold">
                            <i class="bi bi-lightbulb-fill me-2 text-info"></i>Mengapa Memilih Sekolah Kami?
                        </h4>
                        <div class="row text-start">
                            <div class="mb-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                    <span class="text-white fw-medium">Pembinaan prestasi berkualitas</span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                    <span class="text-white fw-medium">Guru profesional dan berpengalaman</span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                    <span class="text-white fw-medium">Fasilitas modern dan lengkap</span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                    <span class="text-white fw-medium">Program pengembangan karakter</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-3">
                    <a href="{{ route('majors') }}" class="btn btn-warning btn-lg w-100 fw-bold">
                        <i class="bi bi-book me-2"></i>Program Jurusan
                    </a>
                </div>
                <div class="mb-3 col-md-3">
                    <a href="{{ route('facilities') }}" class="btn btn-success btn-lg w-100 fw-bold">
                        <i class="bi bi-building me-2"></i>Fasilitas Modern
                    </a>
                </div>
                <div class="mb-3 col-md-3">
                    <a href="{{ route('teachers') }}" class="btn btn-info btn-lg w-100 fw-bold">
                        <i class="bi bi-people me-2"></i>Guru Berkualitas
                    </a>
                </div>
                <div class="mb-3 col-md-3">
                    <a href="{{ route('contact') }}" class="btn btn-danger btn-lg w-100 fw-bold">
                        <i class="bi bi-telephone me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
            <div class="mt-4">
                <p class="mb-0 text-warning fw-bold">
                    <i class="bi bi-star-fill me-1"></i>
                    Raih Prestasi Bersama Kami - Wujudkan Impianmu Menjadi Nyata!
                    <i class="bi bi-star-fill ms-1"></i>
                </p>
            </div>
        </div>
    </section>
@endsection
