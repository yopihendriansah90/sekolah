@extends('layouts.app')

@section('title', 'Profil Guru - ' . ($guru->name ?? 'Tenaga Pengajar'))

@section('content')
    @php
        $displayName = $guru->name ?: 'Nama Guru';
        $displaySubject = $guru->subject ?: 'Mata pelajaran belum diisi';
        $displayNip = $guru->nip ?: '0000000000';
        $displayEmail = $guru->email ?: 'guru@sekolah.sch.id';
        $displayPhone = $guru->phone ?: '08xx-xxxx-xxxx';
        $shortBio = $guru->subject
            ? "Berpengalaman mengajar {$guru->subject} dan fokus pada pembelajaran yang ramah serta mudah dipahami."
            : 'Berpengalaman dalam mendampingi siswa dan menciptakan suasana belajar yang nyaman.';
    @endphp

    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-3 display-5 fw-bold">{{ $displayName }}</h1>
                    <p class="mb-4 lead">{{ $displaySubject }}</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teachers') }}"
                                    class="text-white text-decoration-none">Tenaga Pengajar</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Profil Guru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="mb-4 col-lg-4 mb-lg-0">
                    <div class="text-center border-0 shadow card">
                        <div class="card-body">
                            @if ($guru->getFirstMediaUrl('photos'))
                                <img src="{{ $guru->getFirstMediaUrl('photos') }}"
                                    class="mb-3 rounded-circle img-fluid" alt="{{ $displayName }}"
                                    style="width: 180px; height: 180px; object-fit: cover;">
                            @else
                                <div class="mx-auto mb-3 text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 180px; height: 180px;">
                                    <i class="bi bi-person fs-1"></i>
                                </div>
                            @endif
                            <h4 class="mb-1 fw-bold">{{ $displayName }}</h4>
                            <p class="mb-0 text-primary">{{ $displaySubject }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h4 class="mb-3 fw-bold">Profil Singkat</h4>
                            <p class="text-muted">{{ $shortBio }}</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 d-flex align-items-start">
                                        <i class="mt-1 bi bi-person-badge me-2 text-primary"></i>
                                        <div>
                                            <div class="fw-semibold">NIP</div>
                                            <div class="text-muted">{{ $displayNip }}</div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex align-items-start">
                                        <i class="mt-1 bi bi-book me-2 text-primary"></i>
                                        <div>
                                            <div class="fw-semibold">Mata Pelajaran</div>
                                            <div class="text-muted">{{ $displaySubject }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 d-flex align-items-start">
                                        <i class="mt-1 bi bi-envelope me-2 text-primary"></i>
                                        <div>
                                            <div class="fw-semibold">Email</div>
                                            <div class="text-muted">{{ $displayEmail }}</div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex align-items-start">
                                        <i class="mt-1 bi bi-telephone me-2 text-primary"></i>
                                        <div>
                                            <div class="fw-semibold">Telepon</div>
                                            <div class="text-muted">{{ $displayPhone }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <a href="{{ route('teachers') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Guru
                                </a>
                                <a href="mailto:{{ $displayEmail }}" class="btn btn-primary">
                                    <i class="bi bi-envelope me-2"></i>Kirim Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Info -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="card-body">
                            <h5 class="mb-3 fw-bold">Pengalaman</h5>
                            <p class="mb-0 text-muted">
                                Fokus pada pengembangan karakter siswa dan pembelajaran yang menyenangkan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="card-body">
                            <h5 class="mb-3 fw-bold">Metode Mengajar</h5>
                            <p class="mb-0 text-muted">
                                Menggunakan pendekatan interaktif agar materi mudah dipahami oleh semua siswa.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-4">
                    <div class="border-0 shadow-sm card h-100">
                        <div class="card-body">
                            <h5 class="mb-3 fw-bold">Jam Konsultasi</h5>
                            <p class="mb-0 text-muted">
                                Tersedia konsultasi pada jam sekolah atau sesuai janji dengan wali kelas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
