@extends('layouts.app')

@section('title', 'Tenaga Pengajar - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Tenaga Pengajar</h1>
                    <p class="mb-4 lead">Guru-guru profesional dan berkompeten yang siap membimbing siswa</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Tenaga Pengajar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Teachers Grid -->
    <section class="py-5">
        <div class="container">
            @if ($gurus->count() > 0)
                <div class="row">
                    @foreach ($gurus as $guru)
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
                                    <p class="mb-2 text-primary">{{ $guru->subject }}</p>
                                    <small class="mb-2 text-muted d-block">NIP: {{ $guru->nip }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $gurus->links() }}
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-people fs-1 text-muted"></i>
                            <h4 class="text-muted">Belum ada data guru</h4>
                            <p class="text-muted">Data tenaga pengajar akan segera ditampilkan di sini.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Teacher Stats Section -->
    @if ($gurus->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center row">
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-primary-custom">{{ $gurus->total() }}</h2>
                                <p class="mb-0 text-muted">Total Guru</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-secondary-custom">
                                    {{ $gurus->where('subject', '!=', null)->unique('subject')->count() }}</h2>
                                <p class="mb-0 text-muted">Mata Pelajaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-accent-custom">{{ $gurus->where('email', '!=', null)->count() }}</h2>
                                <p class="mb-0 text-muted">Dengan Email</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 col-md-3">
                        <div class="border-0 shadow-sm card">
                            <div class="card-body">
                                <h2 class="text-accent-custom">{{ $gurus->where('phone', '!=', null)->count() }}</h2>
                                <p class="mb-0 text-muted">Dengan Telepon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Teacher Commitment Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="text-center section-title">Komitmen Kami</h2>
                    <div class="row">
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-book text-primary-custom fs-1"></i>
                                <h5>Pendidikan Berkualitas</h5>
                                <p>Menyampaikan materi pelajaran dengan metode yang efektif dan menarik.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-heart text-secondary-custom fs-1"></i>
                                <h5>Pengembangan Karakter</h5>
                                <p>Membentuk karakter siswa yang baik dan nilai-nilai moral yang tinggi.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-lightbulb text-accent-custom fs-1"></i>
                                <h5>Inovasi Pembelajaran</h5>
                                <p>Menggunakan teknologi dan metode inovatif dalam proses pembelajaran.</p>
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
            <h2 class="mb-4">Ingin Tahu Lebih Banyak?</h2>
            <p class="mb-4 lead">Jelajahi aspek lain dari sekolah kami</p>
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
