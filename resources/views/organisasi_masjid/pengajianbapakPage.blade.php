<x-layout title="Pengajian Bapak-bapak | Baitussalam">
    <div>
        <div class="herosectionBapak d-flex justify-content-center align-items-center">
            <span class="titleHero">Pengajian Bapak-bapak Masjid Baitussalam</span>
            <img src="/assets/images/ornamenGaris.png" alt="ornamenGaris" class="ornamenGaris">
        </div>
        <div class="container py-5">

            <section class="mb-5">
                <h4 class="fw-bold mb-3">Tentang Kami</h4>
                <p class="text-muted">
                    Pengajian bapak-bapak adalah kegiatan rutin keagamaan Islam non-formal yang lazim diadakan di
                    masjid, musholla, atau di lingkungan perumahan/desa di seluruh Indonesia, khusus untuk jamaah
                    pria.
                </p>
            </section>

            <section class="mb-5">
                <h4 class="fw-bold mb-4">Struktur Pengurus</h4>

                <div id="pengurusCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="row g-4 justify-content-center">

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="profile-card-remaja border border-dark-subtle">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
                                            class="rounded-circle">
                                        <h6 class="fw-semibold mb-0">Ketua RW</h6>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="profile-card-remaja border border-dark-subtle">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140061.png"
                                            class="rounded-circle">
                                        <h6 class="fw-semibold mb-0">Pak Mahmud</h6>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="profile-card-remaja border border-dark-subtle">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140037.png"
                                            class="rounded-circle">
                                        <h6 class="fw-semibold mb-0">Pak Sholih</h6>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="profile-card-remaja border border-dark-subtle">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140047.png"
                                            class="rounded-circle">
                                        <h6 class="fw-semibold mb-0">Pak Irwan</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row g-4 justify-content-center">

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="profile-card-remaja border border-dark-subtle">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140036.png"
                                            class="rounded-circle">
                                        <h6 class="fw-semibold mb-0">Rizki</h6>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="profile-card-remaja border border-dark-subtle">
                                        <img src="https://cdn-icons-png.flaticon.com/512/4140/4140060.png"
                                            class="rounded-circle">
                                        <h6 class="fw-semibold mb-0">Alya</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev d-flex justify-content-start" type="button"
                        data-bs-target="#pengurusCarousel" data-bs-slide="prev">
                        <i class="bi bi-chevron-left fs-3 text-dark"></i>
                    </button>

                    <button class="carousel-control-next d-flex justify-content-end" type="button"
                        data-bs-target="#pengurusCarousel" data-bs-slide="next">
                        <i class="bi bi-chevron-right fs-3 text-dark"></i>
                    </button>
                </div>
            </section>

            <section class="text-center mb-5">
                <a href="#" class="btn btn-success btn-lg badge px-4 py-3 fw-light fs-5">
                    Hubungi Kami via WhatsApp
                </a>
            </section>

            <section>
                <h4 class="fw-bold mb-4">Galeri Kegiatan</h4>

                <div class="row g-4">
                    <div class="col-md-4">
                        <img src="{{ asset('assets/images/fotoProfile.jpg') }}"
                            class="img-fluid gallery-img-remaja w-100" alt="fotoprofile">
                    </div>
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1621351183012-e2f9972dd9bf"
                            class="img-fluid gallery-img-remaja w-100">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('assets/images/fotoProfile.jpg') }}"
                            class="img-fluid gallery-img-remaja w-100">
                    </div>
                </div>
            </section>

        </div>
    </div>

</x-layout>
