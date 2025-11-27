@extends('layouts.app')

@section('title', 'Hasil Pencarian: ' . $query . ' - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Breadcrumb -->
    <section class="py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Search Header -->
    <section class="py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2 h3">
                        @if (!empty($query))
                            Hasil Pencarian: <strong>"{{ $query }}"</strong>
                        @else
                            Pencarian
                        @endif
                    </h1>
                    @if ($results->count() > 0)
                        <p class="mb-0 text-muted">Ditemukan {{ $results->count() }} hasil</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <form action="{{ route('search') }}" method="GET" class="d-flex">
                        <input type="text" name="q" value="{{ $query }}" class="form-control me-2"
                            placeholder="Cari lagi..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="py-3">
        <div class="container">
            @if (!empty($query))
                @if ($results->count() > 0)
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Ditemukan {{ $results->count() }} hasil</h3>
                        <div class="btn-group" role="group">
                            <a href="{{ route('news') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-newspaper me-1"></i>Berita
                            </a>
                            <a href="{{ route('events') }}" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-calendar-event me-1"></i>Kegiatan
                            </a>
                            <a href="{{ route('students') }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-mortarboard me-1"></i>Siswa
                            </a>
                            <a href="{{ route('teachers') }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-people me-1"></i>Guru
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($results as $result)
                            <div class="mb-4 col-md-6 col-lg-4">
                                <a href="{{ $result->url }}" class="text-decoration-none">
                                    <div class="border-0 shadow card h-100 card-hover">
                                        @if ($result->image)
                                            <img src="{{ $result->image }}" class="card-img-top"
                                                alt="{{ $result->title }}" style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="text-white card-img-top d-flex align-items-center justify-content-center"
                                                style="height: 200px; background: linear-gradient(135deg, {{ $result->type == 'Berita' ? '#007bff' : ($result->type == 'Kegiatan' ? '#28a745' : ($result->type == 'Siswa' ? '#17a2b8' : ($result->type == 'Guru' ? '#ffc107' : '#6c757d'))) }}, {{ $result->type == 'Berita' ? '#0056b3' : ($result->type == 'Kegiatan' ? '#1e7e34' : ($result->type == 'Siswa' ? '#117a8b' : ($result->type == 'Guru' ? '#e0a800' : '#545b62'))) }});">
                                                <i
                                                    class="bi {{ $result->type == 'Berita' ? 'bi-newspaper' : ($result->type == 'Kegiatan' ? 'bi-calendar-event' : ($result->type == 'Siswa' ? 'bi-mortarboard' : ($result->type == 'Guru' ? 'bi-person' : 'bi-building'))) }} fs-1"></i>
                                            </div>
                                        @endif

                                        <div class="card-body">
                                            <div class="mb-2">
                                                <span
                                                    class="badge bg-{{ $result->type == 'Berita' ? 'primary' : ($result->type == 'Kegiatan' ? 'success' : ($result->type == 'Siswa' ? 'info' : ($result->type == 'Guru' ? 'warning' : 'secondary'))) }}">
                                                    {{ $result->type }}
                                                </span>
                                                @if ($result->category && $result->category != $result->type)
                                                    <span
                                                        class="badge bg-light text-dark ms-1">{{ $result->category }}</span>
                                                @endif
                                            </div>

                                            <h6 class="card-title fw-bold text-dark">{{ $result->title }}</h6>
                                            <div class="card-text text-muted small">
                                                @if ($result->type == 'Berita')
                                                    {!! $result->content !!}
                                                @else
                                                    {{ $result->content }}
                                                @endif
                                            </div>

                                            @if ($result->date)
                                                <div class="mt-2">
                                                    <small class="text-muted">
                                                        <i
                                                            class="bi bi-calendar me-1"></i>{{ $result->date->format('d/m/Y') }}
                                                    </small>
                                                </div>
                                            @endif

                                            @if ($result->author)
                                                <div class="mt-1">
                                                    <small class="text-primary">
                                                        <i class="bi bi-person me-1"></i>{{ $result->author }}
                                                    </small>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="bg-transparent border-0 card-footer">
                                            <div class="btn btn-primary w-100">
                                                <i class="bi bi-arrow-right me-1"></i>
                                                @if ($result->type == 'Berita')
                                                    Baca Berita
                                                @elseif ($result->type == 'Kegiatan')
                                                    Lihat Kegiatan
                                                @elseif ($result->type == 'Siswa')
                                                    Lihat Siswa
                                                @elseif ($result->type == 'Guru')
                                                    Lihat Guru
                                                @else
                                                    Lihat Detail
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- No Results -->
                    <div class="py-5 text-center">
                        <div class="border-0 shadow card">
                            <div class="p-5 card-body">
                                <i class="mb-3 bi bi-search fs-1 text-muted"></i>
                                <h4 class="text-muted">Tidak ada hasil ditemukan</h4>
                                <p class="mb-4 text-muted">Coba gunakan kata kunci yang berbeda atau lebih spesifik</p>

                                <!-- Suggestions -->
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <h6 class="mb-3">Coba cari:</h6>
                                        <div class="flex-wrap gap-2 d-flex justify-content-center">
                                            <a href="{{ route('search', ['q' => 'prestasi']) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-trophy me-1"></i>Prestasi
                                            </a>
                                            <a href="{{ route('search', ['q' => 'kegiatan']) }}"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-calendar-event me-1"></i>Kegiatan
                                            </a>
                                            <a href="{{ route('search', ['q' => 'matematika']) }}"
                                                class="btn btn-outline-info btn-sm">
                                                <i class="bi bi-calculator me-1"></i>Matematika
                                            </a>
                                            <a href="{{ route('search', ['q' => 'olahraga']) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="bi bi-bicycle me-1"></i>Olahraga
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty Search -->
                <div class="py-5 text-center">
                    <div class="border-0 shadow card">
                        <div class="p-5 card-body">
                            <i class="mb-3 bi bi-search fs-1 text-muted"></i>
                            <h4 class="text-muted">Pencarian Sekolah</h4>
                            <p class="text-muted">Masukkan kata kunci untuk mencari berita, kegiatan, siswa, guru, dan
                                fasilitas sekolah</p>

                            <!-- Popular Searches -->
                            <div class="mt-4">
                                <h6 class="mb-3">Pencarian Populer:</h6>
                                <div class="flex-wrap gap-2 d-flex justify-content-center">
                                    <a href="{{ route('search', ['q' => 'berita']) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-newspaper me-1"></i>Berita Sekolah
                                    </a>
                                    <a href="{{ route('search', ['q' => 'siswa berprestasi']) }}"
                                        class="btn btn-outline-success">
                                        <i class="bi bi-trophy me-1"></i>Siswa Berprestasi
                                    </a>
                                    <a href="{{ route('search', ['q' => 'kegiatan']) }}" class="btn btn-outline-info">
                                        <i class="bi bi-calendar-event me-1"></i>Kegiatan Sekolah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Search Tips -->
    @if (!empty($query) && $results->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-lg-8">
                        <h4 class="mb-4 text-center">Tips Pencarian</h4>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <div class="text-center">
                                    <i class="mb-2 bi bi-lightbulb text-warning fs-2"></i>
                                    <h6>Gunakan Kata Kunci</h6>
                                    <p class="small text-muted">Cari dengan nama, mata pelajaran, atau jenis kegiatan</p>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <div class="text-center">
                                    <i class="mb-2 bi bi-filter text-info fs-2"></i>
                                    <h6>Filter Berdasarkan Kategori</h6>
                                    <p class="small text-muted">Gunakan tombol filter untuk kategori tertentu</p>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <div class="text-center">
                                    <i class="mb-2 bi bi-search text-success fs-2"></i>
                                    <h6>Pencarian Spesifik</h6>
                                    <p class="small text-muted">Semakin spesifik kata kunci, hasil lebih akurat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
