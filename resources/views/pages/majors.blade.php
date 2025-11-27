@extends('layouts.app')

@section('title', 'Program Jurusan - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Program Jurusan</h1>
                    <p class="mb-4 lead">Berbagai jurusan yang tersedia untuk mengembangkan potensi siswa</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Program Jurusan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Majors Grid -->
    <section class="py-5">
        <div class="container">
            @if ($jurusans->count() > 0)
                <div class="row">
                    @foreach ($jurusans as $jurusan)
                        <div class="mb-4 col-md-6 col-lg-4">
                            <div class="border-0 shadow card h-100 card-hover">
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <div class="mx-auto text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 80px; height: 80px;">
                                            <i class="bi bi-book fs-2"></i>
                                        </div>
                                    </div>
                                    <h6 class="card-title fw-bold">{{ $jurusan->name }}</h6>
                                    <p class="mb-3 text-muted small">{{ $jurusan->description }}</p>
                                    <div class="text-center">
                                        <span class="badge bg-primary">{{ $jurusan->siswas_count }} Siswa</span>
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
                            <i class="mb-3 bi bi-book fs-1 text-muted"></i>
                            <h4 class="text-muted">Belum ada program jurusan</h4>
                            <p class="text-muted">Informasi program jurusan akan segera ditampilkan di sini.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Major Benefits Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="text-center section-title">Keunggulan Program Kami</h2>
                    <div class="row">
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-person-check text-primary fs-1"></i>
                                <h5>Pembimbing Profesional</h5>
                                <p>Guru-guru berpengalaman siap membimbing siswa dalam setiap jurusan.</p>
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
                                <i class="mb-3 bi bi-rocket text-warning fs-1"></i>
                                <h5>Persiapan Karier</h5>
                                <p>Program yang dirancang untuk mempersiapkan siswa menghadapi dunia kerja.</p>
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
            <h2 class="mb-4">Siap Memilih Jurusan?</h2>
            <p class="mb-4 lead">Bergabunglah dengan program jurusan yang sesuai dengan minat dan bakat Anda</p>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <a href="{{ route('about') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-info-circle me-2"></i>Tentang Kami
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('students') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-mortarboard me-2"></i>Siswa Berprestasi
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
