@extends('layouts.app')

@section('title', 'Fasilitas Sekolah - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-section"
        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: white; padding: 100px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Fasilitas Sekolah</h1>
                    <p class="mb-4 lead">Fasilitas modern dan lengkap untuk mendukung kegiatan belajar mengajar</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Fasilitas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Grid -->
    <section class="py-5">
        <div class="container">
            @if ($fasilitas->count() > 0)
                <div class="row">
                    @foreach ($fasilitas as $fasilitas_item)
                        <div class="mb-4 col-md-6 col-lg-4">
                            <div class="border-0 shadow card h-100 card-hover facility-card">
                                @if ($fasilitas_item->getFirstMediaUrl('images'))
                                    <img src="{{ $fasilitas_item->getFirstMediaUrl('images') }}" class="card-img-top"
                                        alt="{{ $fasilitas_item->name }}">
                                @else
                                    <div class="text-white card-img-top bg-primary d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="bi bi-building fs-1"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $fasilitas_item->name }}</h5>
                                    <p class="card-text">{{ Str::limit($fasilitas_item->description, 120) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $fasilitas->links() }}
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-building fs-1 text-muted"></i>
                            <h4 class="text-muted">Belum ada data fasilitas</h4>
                            <p class="text-muted">Fasilitas sekolah akan segera ditampilkan di sini.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Facilities Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="mb-4 text-center">Mengapa Fasilitas Penting?</h2>
                    <div class="row">
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-lightbulb text-warning fs-1"></i>
                                <h5>Pembelajaran Optimal</h5>
                                <p>Fasilitas yang lengkap mendukung proses pembelajaran yang efektif dan menarik.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-shield-check text-success fs-1"></i>
                                <h5>Keamanan & Kenyamanan</h5>
                                <p>Lingkungan belajar yang aman dan nyaman untuk pengembangan siswa.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-4">
                            <div class="text-center">
                                <i class="mb-3 bi bi-trophy text-primary fs-1"></i>
                                <h5>Pengembangan Bakat</h5>
                                <p>Fasilitas pendukung untuk mengembangkan berbagai bakat dan minat siswa.</p>
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
            <h2 class="mb-4">Ingin Melihat Lebih Banyak?</h2>
            <p class="mb-4 lead">Jelajahi aspek lain dari sekolah kami</p>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <a href="{{ route('about') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-info-circle me-2"></i>Tentang Kami
                    </a>
                </div>
                <div class="mb-3 col-md-4">
                    <a href="{{ route('teachers') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-people me-2"></i>Tenaga Pengajar
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
