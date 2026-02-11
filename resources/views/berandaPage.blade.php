<x-layout title="Beranda | Baitussalam">
    <div class="herosectionBeranda d-flex justify-content-center align-items-center">
        <span class="titleHero">Baitussalam Kalirejo Permai
        </span>
    </div>
    <div class="cardKegiatanContainer">
        <div class="container my-5">
            <div class="row g-4 justify-content-center">

                <div class="col-6 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark" href="{{ route('kegiatan') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-moon-stars"></i>
                            </div>
                            <h6 class="fw-bold mt-3 text-uppercase small">Kegiatan</h6>
                            <p class="text-muted extra-small mb-0 d-none d-sm-block">
                                Agenda & aktivitas masjid
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark" href="{{ route('donasi') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <h6 class="fw-bold mt-3 text-uppercase small">Donasi</h6>
                            <p class="text-muted extra-small mb-0 d-none d-sm-block">
                                Infaq & sedekah online
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark" href="{{ route('dokumen') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-folder-check"></i>
                            </div>
                            <h6 class="fw-bold mt-3 text-uppercase small">Dokumen</h6>
                            <p class="text-muted extra-small mb-0 d-none d-sm-block">
                                Laporan keuangan & arsip
                            </p>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="feature-card text-center h-100">
                        <a class="text-decoration-none text-dark" href="{{ route('penjadwalan') }}">
                            <div class="icon-box-new">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h6 class="fw-bold mt-3 text-uppercase small">Penjadwalan</h6>
                            <p class="text-muted extra-small mb-0 d-none d-sm-block">
                                Waktu shalat & acara
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tentangBerandaContainer">
        <div class="container py-5">
            <div class="row align-items-start g-4">

                <h5 class="fw-bold text-uppercase">Tentang Kami</h5>
                <div class="col-lg-6">

                    <img src="assets/images/gambarMasjid.png" class="img-fluid rounded-4 mb-4" alt="Tentang Kami">

                    <h4 class="fw-semibold">Membantumu menjadi lebih baik</h4>
                    <p class="text-muted">
                        Membuat anda lebih fokus dalam memperbaiki diri dan meningkatkan keimanan.
                    </p>
                </div>

                <div class="col-lg-6">
                    <div class="d-flex flex-column gap-3">

                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/images/gambarMasjid.png" class="rounded-3" width="80" height="60"
                                style="object-fit: cover;">
                            <p class="mb-0 small fw-medium">
                                Sukses dalam Mengisi malam Lailatul Qadar
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/images/gambarMasjid.png" class="rounded-3" width="80" height="60">
                            <p class="mb-0 small fw-medium">
                                Sukses dalam Mengisi malam Lailatul Qadar
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/images/gambarMasjid.png" class="rounded-3" width="80" height="60">
                            <p class="mb-0 small fw-medium">
                                Tafsir Surah Ar-Rahman
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/images/gambarMasjid.png" class="rounded-3" width="80" height="60">
                            <p class="mb-0 small fw-medium">
                                Tafsir Surah Al-Mulk
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/images/gambarMasjid.png" class="rounded-3" width="80" height="60">
                            <p class="mb-0 small fw-medium">
                                Pentingnya menjaga Ukhuwah Islamiyah
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="galeriContainer">
        <div class="container py-5">
            <h5 class="fw-bold text-uppercase">Galeri</h5>

            <p class="text-muted mb-4" style="max-width: 600px;">
                “Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua”
            </p>

            <div class="row g-4">
                @foreach (['idaroh' => 'IDAROH', 'riayah' => 'RI’AYAH', 'imarah' => 'IMARAH'] as $section => $title)
                    @php $img = $galeri[$section] ?? null; @endphp
                    <div class="col-md-4">
                        <div class="img-card cardGaleri">
                            @if ($img)
                                <a href="{{ route('galeri.section', $section) }}">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid"
                                        loading="lazy" alt="{{ $img->caption }}">
                                </a>
                            @else
                                <img src="assets/images/background2.png" class="img-fluid" loading="lazy"
                                    alt="Belum ada foto">
                            @endif
                        </div>
                        <h6 class="fw-semibold mt-2 text-center">{{ $title }}</h6>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-layout>
