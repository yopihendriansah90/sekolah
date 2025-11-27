@extends('layouts.app')

@section('title', 'Kontak Kami - ' . ($settings['school_name'] ?? 'Sekolah Indonesia'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Hubungi Kami</h1>
                    <p class="mb-4 lead">Kami siap membantu dan menjawab pertanyaan Anda</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Beranda</a></li>
                            <li class="text-white breadcrumb-item active" aria-current="page">Kontak</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info & Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="mb-4 col-lg-5">
                    <div class="border-0 shadow card h-100">
                        <div class="p-4 card-body">
                            <h3 class="mb-4 card-title">Informasi Kontak</h3>

                            <div class="mb-4">
                                <h5><i
                                        class="bi bi-building text-primary me-2"></i>{{ $settings['school_name'] ?? 'SMA Negeri 1 Indonesia' }}
                                </h5>
                            </div>

                            <div class="mb-3">
                                <h6><i class="bi bi-geo-alt text-secondary-custom me-2"></i>Alamat</h6>
                                <p class="mb-0">
                                    {{ $settings['school_address'] ?? 'Jl. Pendidikan No. 123, Jakarta Pusat, DKI Jakarta 10110' }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <h6><i class="bi bi-telephone text-accent-custom me-2"></i>Telepon</h6>
                                <p class="mb-1">{{ $settings['school_phone'] ?? '+62 21 1234 5678' }}</p>
                                @if ($settings['school_phone'] ?? false)
                                    <a href="tel:{{ $settings['school_phone'] }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-telephone me-1"></i>Hubungi Sekarang
                                    </a>
                                @endif
                            </div>

                            <div class="mb-3">
                                <h6><i class="bi bi-envelope text-accent-custom me-2"></i>Email</h6>
                                <p class="mb-1">{{ $settings['school_email'] ?? 'info@sman1-indonesia.sch.id' }}</p>
                                @if ($settings['school_email'] ?? false)
                                    <a href="mailto:{{ $settings['school_email'] }}"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-envelope me-1"></i>Kirim Email
                                    </a>
                                @endif
                            </div>

                            <div class="mb-3">
                                <h6><i class="bi bi-globe text-secondary me-2"></i>Website</h6>
                                <p class="mb-1">{{ $settings['school_website'] ?? 'https://sman1-indonesia.sch.id' }}</p>
                            </div>

                            <div class="mt-4">
                                <h6>Media Sosial</h6>
                                <div class="gap-2 d-flex">
                                    @if ($settings['social_facebook'] ?? false)
                                        <a href="{{ $settings['social_facebook'] }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                    @endif
                                    @if ($settings['social_instagram'] ?? false)
                                        <a href="{{ $settings['social_instagram'] }}" target="_blank"
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    @endif
                                    @if ($settings['social_youtube'] ?? false)
                                        <a href="{{ $settings['social_youtube'] }}" target="_blank"
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-youtube"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="border-0 shadow card">
                        <div class="p-4 card-body">
                            <h3 class="mb-4 card-title">Kirim Pesan</h3>
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subjek *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Pilih Subjek</option>
                                        <option value="informasi">Informasi Umum</option>
                                        <option value="pendaftaran">Pendaftaran Siswa</option>
                                        <option value="fasilitas">Fasilitas Sekolah</option>
                                        <option value="guru">Tenaga Pengajar</option>
                                        <option value="komplain">Keluhan/Saran</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Pesan *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required
                                        placeholder="Tuliskan pesan Anda di sini..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Optional - can be added later) -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="mb-4 text-center col-12">
                    <h2 class="section-title">Lokasi Sekolah</h2>
                    <p class="text-muted">Temukan kami di peta</p>
                </div>
                <div class="mx-auto col-lg-10">
                    <div class="border-0 shadow card">
                        <div class="p-0 card-body">
                            <!-- Placeholder for Google Maps -->
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                                <div class="text-center">
                                    <i class="mb-3 bi bi-geo-alt fs-1 text-muted"></i>
                                    <h5 class="text-muted">Peta Lokasi</h5>
                                    <p class="text-muted">Integrasi Google Maps akan ditambahkan</p>
                                    <small
                                        class="text-muted">{{ $settings['school_address'] ?? 'Jl. Pendidikan No. 123, Jakarta Pusat' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact Cards -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="mb-5 text-center col-12">
                    <h2 class="section-title">Kontak Cepat</h2>
                    <p class="lead">Butuh informasi segera? Hubungi kami melalui berbagai cara</p>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-md-3">
                    <div class="text-center border-0 shadow card h-100">
                        <div class="p-4 card-body">
                            <i class="mb-3 bi bi-telephone fs-1 text-primary-custom"></i>
                            <h5>Telepon</h5>
                            <p>Hubungi kami langsung untuk informasi cepat</p>
                            @if ($settings['school_phone'] ?? false)
                                <a href="tel:{{ $settings['school_phone'] }}" class="btn btn-primary">Telepon</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="text-center border-0 shadow card h-100">
                        <div class="p-4 card-body">
                            <i class="mb-3 bi bi-envelope fs-1 text-secondary-custom"></i>
                            <h5>Email</h5>
                            <p>Kirim email untuk pertanyaan detail</p>
                            @if ($settings['school_email'] ?? false)
                                <a href="mailto:{{ $settings['school_email'] }}" class="btn btn-secondary">Email</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="text-center border-0 shadow card h-100">
                        <div class="p-4 card-body">
                            <i class="mb-3 bi bi-whatsapp fs-1 text-secondary-custom"></i>
                            <h5>WhatsApp</h5>
                            <p>Chat langsung via WhatsApp</p>
                            @if ($settings['school_phone'] ?? false)
                                <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $settings['school_phone']) }}"
                                    target="_blank" class="btn btn-secondary">WhatsApp</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-md-3">
                    <div class="text-center border-0 shadow card h-100">
                        <div class="p-4 card-body">
                            <i class="mb-3 bi bi-geo-alt fs-1 text-accent-custom"></i>
                            <h5>Lokasi</h5>
                            <p>Kunjungi kami langsung di sekolah</p>
                            <button class="btn btn-accent"
                                onclick="alert('Lokasi: {{ $settings['school_address'] ?? 'Alamat belum diatur' }}')">Lihat
                                Lokasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
