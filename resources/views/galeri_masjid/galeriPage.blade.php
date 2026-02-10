<x-layout title="Galeri | Baitussalam">
    <div>
        <div class="container my-5">

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold text-uppercase">
                        IDAROH <span class="fw-normal">(Manajemen dan Administrasi)</span>
                    </h6>
                    <a href="{{ route('galeri.section', 'idaroh') }}" class="text-decoration-none small text-black">
                        Selengkapnya →
                    </a>
                </div>

                <div class="row g-3">
                    @forelse($idaroh as $img)
                    <div class="col-md-4">
                        <div class="img-card cardGaleri">
                            <img
                                src="{{ asset('storage/'.$img->image_path) }}"
                                class="img-fluid"
                                loading="lazy"
                                alt="{{ $img->caption }}">
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-muted small">
                        Belum ada foto.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold text-uppercase">
                        RI’AYAH <span class="fw-normal">(Perawatan dan Pemeliharaan Masjid)</span>
                    </h6>
                    <a href="{{ route('galeri.section', 'riayah') }}" class="text-decoration-none small text-black">
                        Selengkapnya →
                    </a>
                </div>

                <div class="row g-3">
                    @forelse($riayah as $img)
                    <div class="col-md-4">
                        <div class="img-card cardGaleri">
                            <img
                                src="{{ asset('storage/'.$img->image_path) }}"
                                class="img-fluid"
                                loading="lazy"
                                alt="{{ $img->caption }}">
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-muted small">
                        Belum ada foto.
                    </div>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold text-uppercase">
                        IMARAH <span class="fw-normal">(Kegiatan Keagamaan)</span>
                    </h6>
                    <a href="{{ route('galeri.section', 'imarah') }}" class="text-decoration-none small text-black">
                        Selengkapnya →
                    </a>
                </div>

                <div class="row g-3">
                    @forelse($imarah as $img)
                    <div class="col-md-4">
                        <div class="img-card cardGaleri">
                            <img
                                src="{{ asset('storage/'.$img->image_path) }}"
                                class="img-fluid"
                                loading="lazy"
                                alt="{{ $img->caption }}">
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-muted small">
                        Belum ada foto.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-layout>