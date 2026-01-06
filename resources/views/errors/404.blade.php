@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <section class="py-5" style="background: linear-gradient(135deg, var(--light-blue) 0%, var(--warm-gray) 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4 display-1 fw-bold text-primary">404</div>
                    <h1 class="mb-3 fw-bold">Maaf, halamannya belum ada</h1>
                    <p class="mb-4 lead text-muted">
                        Sepertinya alamat yang kamu buka tidak ditemukan atau sudah dipindah.
                        Tidak apa-apa, kamu bisa kembali ke halaman utama atau cari informasi lain.
                    </p>
                    <div class="flex-wrap gap-2 d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="px-4 btn btn-primary btn-lg">
                            <i class="bi bi-house-door me-2"></i>Kembali ke Beranda
                        </a>
                        <a href="{{ route('search') }}" class="px-4 btn btn-outline-primary btn-lg">
                            <i class="bi bi-search me-2"></i>Cari Informasi
                        </a>
                        <a href="{{ route('contact') }}" class="px-4 btn btn-outline-secondary btn-lg">
                            <i class="bi bi-telephone me-2"></i>Hubungi Kami
                        </a>
                    </div>
                    <p class="mt-4 text-muted small">
                        Jika menurutmu ini kesalahan, beri tahu kami ya.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
