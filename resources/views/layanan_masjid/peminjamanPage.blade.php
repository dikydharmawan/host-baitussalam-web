<x-layout title="Peminjaman Fasilitas | Baitussalam">
    <div>
        <div class="container my-4">
            <h4 class="fw-bold">Peminjaman Fasilitas</h4>
            <p class="text-muted mb-4">
                Informasi pengajuan dan syarat peminjaman fasilitas Masjid Baitussalam bagi kegiatan.
            </p>

            <div class="row g-4 align-items-start">

                <div class="col-lg-7">
                    <img src="{{ asset('assets/images/gambarMasjid.png') }}"
                        class="img-fluid rounded-3 shadow-sm w-100"
                        alt="Masjid">
                </div>

                <div class="col-lg-5">

                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header cardHeaderPeminjaman fw-normal rounded-top-4">
                            <i class="bi bi-briefcase me-2"></i> Langkah Peminjaman
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    ✦ Perawatan bangunan masjid
                                </li>
                                <li class="mb-2">
                                    ✦ Kebersihan dan Sanitasi
                                </li>
                                <li class="mb-2">
                                    ✦ Keamanan dan fasilitas
                                </li>
                                <li>
                                    ✦ Pengelolaan inventaris fisik
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header cardHeaderPeminjaman fw-normal rounded-top-4">
                            <i class="bi bi-tags me-2"></i> Syarat dan Ketentuan
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">✦ Perawatan bangunan masjid</li>
                                <li class="mb-2">✦ Kebersihan dan Sanitasi</li>
                                <li class="mb-2">✦ Keamanan dan fasilitas</li>
                                <li>✦ Pengelolaan inventaris fisik</li>
                            </ul>
                        </div>
                    </div>

                    <div class="buttonPeminjaman">
                        <a href="https://wa.me/628xxxxxxxxxx" class="btn btn-success badge px-4 py-3 fw-normal">
                            <i class="bi bi-whatsapp me-2"></i>
                            Hubungi Kami via WhatsApp
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout>