@extends('layouts.app')

@section('title', $jurusan->name . ' - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <div class="mb-4">
                        <div class="mx-auto text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 100px; height: 100px;">
                            <i class="bi bi-book fs-1"></i>
                        </div>
                    </div>
                    <h1 class="mb-4 display-4 fw-bold">{{ $jurusan->name }}</h1>
                    <p class="mb-4 lead">{{ $jurusan->description }}</p>
                    <div class="mb-4">
                        <span class="px-4 py-2 badge bg-light text-primary fs-6 me-2">
                            <i class="bi bi-people me-1"></i>{{ $jurusan->siswas_count }} Siswa
                        </span>
                        <span class="px-4 py-2 badge bg-light text-success fs-6">
                            <i class="bi bi-person-check me-1"></i>{{ $gurus->count() }} Guru
                        </span>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('majors') }}"
                                    class="text-white text-decoration-none">Program Jurusan</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">{{ $jurusan->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Major Description -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="mb-4 text-center section-title">Tentang Program {{ $jurusan->name }}</h2>
                    <div class="p-4 bg-light rounded-3">
                        <p class="mb-0 lead">{{ $jurusan->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Teachers Section -->
    @if ($gurus->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4 text-center section-title">Tenaga Pengajar</h2>
                <div class="row">
                    @foreach ($gurus as $guru)
                        <div class="mb-4 col-md-6 col-lg-3">
                            <div class="text-center border-0 shadow card h-100 card-hover">
                                @if ($guru->getFirstMediaUrl('photos'))
                                    <img src="{{ $guru->getFirstMediaUrl('photos') }}"
                                        class="mx-auto mt-3 card-img-top rounded-circle" alt="{{ $guru->name }}"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <div class="mx-auto mt-3 text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 100px; height: 100px;">
                                        <i class="bi bi-person fs-2"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $guru->name }}</h6>
                                    <p class="mb-2 text-primary">{{ $guru->subject }}</p>
                                    <small class="mb-2 text-muted d-block">NIP: {{ $guru->nip }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Students Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center section-title">Siswa Program {{ $jurusan->name }}</h2>

            @if ($siswas->count() > 0)
                <div class="row">
                    @foreach ($siswas as $siswa)
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
                                    <p class="mb-1 text-primary">{{ $siswa->class }}</p>
                                    <small class="mb-2 text-muted d-block">NIS: {{ $siswa->nis }}</small>

                                    @if ($siswa->achievement_title)
                                        <div class="p-3 border rounded bg-success bg-opacity-10 border-success">
                                            <h6 class="mb-2 text-success fw-bold">
                                                <i class="bi bi-trophy-fill me-1"></i>{{ $siswa->achievement_title }}
                                            </h6>
                                            <p class="mb-1 small">{{ $siswa->achievement_description }}</p>
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">{{ $siswa->competition_name }}</small>
                                                <small
                                                    class="text-white badge bg-success">{{ $siswa->achievement_year }}</small>
                                            </div>
                                            <div class="mt-2">
                                                <span
                                                    class="badge bg-light text-dark">{{ ucfirst($siswa->achievement_category) }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="p-3 text-center rounded bg-light">
                                            <small class="text-muted">Siswa berpotensi tinggi</small>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $siswas->links() }}
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-mortarboard fs-1 text-muted"></i>
                            <h4 class="text-muted">Belum ada siswa terdaftar</h4>
                            <p class="text-muted">Siswa program {{ $jurusan->name }} akan segera ditampilkan di sini.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Program Benefits -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="text-center section-title">Keunggulan Program {{ $jurusan->name }}</h2>
                    <div class="row">
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-rocket text-primary fs-1"></i>
                                <h5>Peluang Karier</h5>
                                <p>Persiapan karir di bidang {{ strtolower($jurusan->name) }} dengan prospek yang cerah.
                                </p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-tools text-success fs-1"></i>
                                <h5>Fasilitas Modern</h5>
                                <p>Laboratorium dan peralatan modern untuk mendukung pembelajaran praktis.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-person-check text-warning fs-1"></i>
                                <h5>Guru Kompeten</h5>
                                <p>Guru-guru berpengalaman dan profesional di bidang {{ strtolower($jurusan->name) }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-white bg-primary">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold">Ingin Bergabung dengan Program {{ $jurusan->name }}?</h2>
            <p class="mb-4 lead">Mulai perjalanan karirmu di bidang {{ strtolower($jurusan->name) }} bersama kami</p>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <a href="{{ route('facilities') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-building me-2"></i>Lihat Fasilitas
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('students') }}" class="btn btn-success btn-lg w-100">
                        <i class="bi bi-mortarboard me-2"></i>Lihat Prestasi Siswa
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('contact') }}" class="btn btn-warning btn-lg w-100">
                        <i class="bi bi-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('majors') }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Semua Jurusan
                </a>
            </div>
        </div>
    </section>
@endsection
