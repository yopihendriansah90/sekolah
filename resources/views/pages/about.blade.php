@extends('layouts.app')

@section('title', 'Tentang Kami - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-section"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 100px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Tentang {{ $settings['school_name'] ?? 'Sekolah Indonesia' }}</h1>
                    <p class="mb-4 lead">Mengenal lebih dalam tentang sekolah kami, visi, misi, dan sejarah perjalanan</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Tentang Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-eye text-primary fs-1"></i>
                            <h4 class="card-title">Visi</h4>
                            <p class="card-text">
                                {{ $settings['school_vision'] ?? 'Mencetak generasi unggul yang berakhlak mulia dan berprestasi.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-target text-success fs-1"></i>
                            <h4 class="card-title">Misi</h4>
                            <p class="card-text">
                                {{ $settings['school_mission'] ?? 'Menyediakan pendidikan berkualitas dengan kurikulum modern dan tenaga pengajar profesional.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow card h-100">
                        <div class="p-4 text-center card-body">
                            <i class="mb-3 bi bi-clock-history text-info fs-1"></i>
                            <h4 class="card-title">Sejarah</h4>
                            <p class="card-text">
                                {{ $settings['school_history'] ?? 'Sekolah ini didirikan dengan tujuan memberikan pendidikan berkualitas sejak tahun 2000.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-8">
                    <h2 class="mb-5 text-center">Informasi Sekolah</h2>
                    <div class="row">
                        <div class="mb-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-building me-2 text-primary"></i>Nama Sekolah</h5>
                                    <p class="card-text">{{ $settings['school_name'] ?? 'SMA Negeri 1 Indonesia' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-geo-alt me-2 text-success"></i>Alamat</h5>
                                    <p class="card-text">
                                        {{ $settings['school_address'] ?? 'Jl. Pendidikan No. 123, Jakarta Pusat' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-telephone me-2 text-info"></i>Telepon</h5>
                                    <p class="card-text">{{ $settings['school_phone'] ?? '+62 21 1234 5678' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 col-md-6">
                            <div class="border-0 shadow-sm card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-envelope me-2 text-warning"></i>Email</h5>
                                    <p class="card-text">{{ $settings['school_email'] ?? 'info@sman1-indonesia.sch.id' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Description Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="mb-4 text-center">Deskripsi Lengkap</h2>
                    <div class="border-0 shadow card">
                        <div class="p-4 card-body">
                            <p class="lead">
                                {{ $settings['school_description'] ?? 'Sekolah berkualitas dengan pendidikan terbaik untuk masa depan siswa.' }}
                            </p>
                            <p>Sekolah kami berkomitmen untuk memberikan pendidikan yang berkualitas tinggi dengan
                                pendekatan modern dan inovatif. Kami memiliki tenaga pengajar yang profesional dan
                                berpengalaman, fasilitas yang lengkap, serta kurikulum yang sesuai dengan perkembangan
                                zaman.</p>
                            <p>Dalam setiap aspek pendidikan, kami selalu berusaha memberikan yang terbaik untuk siswa kami.
                                Mulai dari pembelajaran akademik hingga pengembangan karakter dan bakat siswa.</p>
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
            <p class="mb-4 lead">Jelajahi halaman lainnya untuk melihat fasilitas, tenaga pengajar, dan kegiatan sekolah
                kami</p>
            <div class="row">
                <div class="mb-3 col-md-3">
                    <a href="{{ route('facilities') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-building me-2"></i>Fasilitas
                    </a>
                </div>
                <div class="mb-3 col-md-3">
                    <a href="{{ route('teachers') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-people me-2"></i>Guru
                    </a>
                </div>
                <div class="mb-3 col-md-3">
                    <a href="{{ route('students') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-mortarboard me-2"></i>Siswa
                    </a>
                </div>
                <div class="mb-3 col-md-3">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg w-100">
                        <i class="bi bi-envelope me-2"></i>Kontak
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
