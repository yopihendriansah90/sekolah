@extends('layouts.app')

@section('title', 'Kegiatan Sekolah - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Kegiatan Sekolah</h1>
                    <p class="mb-4 lead">Berbagai kegiatan dan acara yang diselenggarakan oleh sekolah</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Kegiatan Sekolah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="py-5">
        <div class="container">
            @if ($events->count() > 0)
                <div class="row">
                    @foreach ($events as $event)
                        <div class="mb-4 col-md-6 col-lg-4">
                            <div class="border-0 shadow card h-100 card-hover">
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <div class="mx-auto text-white bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 80px; height: 80px;">
                                            <i class="bi bi-calendar-event fs-2"></i>
                                        </div>
                                    </div>
                                    <h6 class="card-title fw-bold">{{ $event->title }}</h6>
                                    <p class="mb-2 text-muted small">{{ $event->description }}</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-primary">
                                                <i
                                                    class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-success">
                                                <i class="bi bi-geo-alt me-1"></i>{{ $event->location ?? 'TBA' }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $events->links() }}
                </div>
            @else
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-calendar-event fs-1 text-muted"></i>
                            <h4 class="text-muted">Belum ada kegiatan</h4>
                            <p class="text-muted">Informasi kegiatan sekolah akan segera ditampilkan di sini.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Event Types Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10">
                    <h2 class="text-center section-title">Jenis Kegiatan</h2>
                    <div class="row">
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-flag text-primary fs-1"></i>
                                <h5>Hari Besar</h5>
                                <p>Perayaan hari-hari besar nasional dan keagamaan.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-trophy text-warning fs-1"></i>
                                <h5>Kompetisi</h5>
                                <p>Lomba dan kompetisi antar siswa dan sekolah.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-book text-success fs-1"></i>
                                <h5>Pendidikan</h5>
                                <p>Workshop dan seminar pendidikan.</p>
                            </div>
                        </div>
                        <div class="mb-4 col-md-3">
                            <div class="text-center">
                                <i class="mb-3 bi bi-heart text-danger fs-1"></i>
                                <h5>Sosial</h5>
                                <p>Kegiatan sosial dan bakti masyarakat.</p>
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
            <h2 class="mb-4">Ingin Terlibat?</h2>
            <p class="mb-4 lead">Bergabunglah dalam kegiatan-kegiatan menarik di sekolah kami</p>
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
