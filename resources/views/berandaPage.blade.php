<x-layout title="Beranda | Baitussalam">
    <div class="herosectionBeranda d-flex justify-content-center align-items-center">
        <span class="titleHero">Baitussalam Kalirejo Permai
        </span>
    </div>
    <div class="cardKegiatanContainer">
        <div class="container py-5">
            <div class="row g-3 g-lg-4 justify-content-center">

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark d-block w-100" href="{{ route('kegiatan') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-moon-stars"></i>
                            </div>
                            <h6 class="fw-bold mt-2 text-uppercase">Kegiatan</h6>
                            <p class="text-muted extra-small mb-0 d-none d-md-block">
                                Agenda & aktivitas masjid
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark d-block w-100" href="{{ route('donasi') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <h6 class="fw-bold mt-2 text-uppercase">Donasi</h6>
                            <p class="text-muted extra-small mb-0 d-none d-md-block">
                                Infaq & sedekah online
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark d-block w-100" href="{{ route('dokumen') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-folder-check"></i>
                            </div>
                            <h6 class="fw-bold mt-2 text-uppercase">Dokumen</h6>
                            <p class="text-muted extra-small mb-0 d-none d-md-block">
                                Laporan keuangan & arsip
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark d-block w-100" href="{{ route('penjadwalan') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h6 class="fw-bold mt-2 text-uppercase">Penjadwalan</h6>
                            <p class="text-muted extra-small mb-0 d-none d-md-block">
                                Waktu shalat & acara
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tentangBerandaContainer bg-light">
        <div class="container py-5">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <h6 class="text-success fw-bold text-uppercase mb-3">Tentang Kami</h6>
                        <h2 class="fw-bold mb-4">Membantumu Menjadi <span class="text-success">Lebih Baik</span></h2>
                        <p class="text-muted fs-5 mb-5">
                            Fokus dalam memperbaiki diri dan meningkatkan keimanan bersama Masjid Baitussalam Kalirejo
                            Permai.
                        </p>
                        <img src="{{ asset('assets/images/gambarMasjid.png') }}" class="img-fluid rounded-4 shadow-sm"
                            alt="Tentang Kami">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="d-flex flex-column gap-4">
                        @foreach (['Sukses dalam Mengisi malam Lailatul Qadar', 'Tafsir Surah Ar-Rahman', 'Tafsir Surah Al-Mulk', 'Pentingnya menjaga Ukhuwah Islamiyah'] as $item)
                            <div
                                class="d-flex align-items-center gap-4 bg-white p-3 rounded-4 shadow-sm hover-translate shadow-hover transition-all">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/gambarMasjid.png') }}" class="rounded-3 shadow-sm"
                                        width="100" height="75" style="object-fit: cover;">
                                </div>
                                <h6 class="mb-0 fw-bold">{{ $item }}</h6>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="galeriContainer">
        <div class="container py-5">
            <div class="row mb-5 align-items-end">
                <div class="col-lg-6">
                    <h6 class="text-success fw-bold text-uppercase mb-3">Galeri Kami</h6>
                    <h2 class="fw-bold mb-0">Dokumentasi Kegiatan <br>Masjid Baitussalam</h2>
                </div>
                <div class="col-lg-6">
                    <p class="text-muted mb-0 mt-3 mt-lg-0">
                        Kumpulan momen berharga dalam berbagai kegiatan keagamaan, sosial, dan pembangunan di lingkungan
                        masjid kami.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                @foreach (['idaroh' => 'IDAROH', 'riayah' => 'RI’AYAH', 'imarah' => 'IMARAH'] as $section => $title)
                    @php $img = $galeri[$section] ?? null; @endphp
                    <div class="col-md-4">
                        <div class="gallery-card-new overflow-hidden rounded-4 shadow-sm position-relative">
                            @if ($img)
                                <a href="{{ route('galeri.section', $section) }}" class="d-block overflow-hidden">
                                    <img src="{{ asset('storage/' . $img->image_path) }}"
                                        class="img-fluid w-100 hover-scale transition-all" loading="lazy"
                                        alt="{{ $img->caption }}" style="aspect-ratio: 4/3; object-fit: cover;">
                                    <div
                                        class="gallery-badge position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white text-center fw-bold">
                                        {{ $title }}
                                    </div>
                                </a>
                            @else
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ asset('assets/images/background2.png') }}" class="img-fluid w-100"
                                        loading="lazy" alt="Belum ada foto"
                                        style="aspect-ratio: 4/3; object-fit: cover;">
                                    <div
                                        class="gallery-badge position-absolute bottom-0 start-0 w-100 p-3 bg-gradient-dark text-white text-center fw-bold">
                                        {{ $title }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-layout>
