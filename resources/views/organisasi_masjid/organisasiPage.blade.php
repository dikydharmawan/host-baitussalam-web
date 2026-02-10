<x-layout title="Organisasi | Baitussalam">
    <div>
        <div class="herosectionOrganisasi">
            <div class="container">
                <h1 class="fw-bold">
                    Organisasi <br>
                    Masjid Baitussalam
                </h1>

                <a href="{{ route('penjadwalan') }}" class="btn btn-success rounded-pill px-4 py-2 mt-3">
                    Lihat Jadwal Kegiatan
                </a>
            </div>
        </div>

        <div class="container hero-card-wrapper">
            <div class="row justify-content-center g-4">
                <div class="col-md-4 col-lg-3">
                    <a class="text-decoration-none text-dark" href="{{ route('remajamasjid') }}">
                        <div class="card text-center border-0 shadow-sm rounded-4 p-4 cardItemsOrganisasi">
                            <i class="bi bi-people fs-1 mb-3"></i>
                            <p class="fw-semibold mb-0">Remaja Masjid</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-lg-3">
                    <a class="text-decoration-none text-dark" href="{{ route('pengajianannisa') }}">
                        <div class="card text-center border-0 shadow-sm rounded-4 p-4 cardItemsOrganisasi">
                            <i class="bi bi-person-hearts fs-1 mb-3"></i>
                            <p class="fw-semibold mb-0">Ibu-ibu Pengajian</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-lg-3">
                    <a class="text-decoration-none text-dark" href="{{ route('pengajianbapak') }}">
                        <div class="card text-center border-0 shadow-sm rounded-4 p-4 cardItemsOrganisasi">
                            <i class="bi bi-person fs-1 mb-3"></i>
                            <p class="fw-semibold mb-0">
                                Bapak-bapak <br> Pengajian / Jamaah
                            </p>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        <div class="container py-5">
            <h5 class="fw-bold mb-4">Kepengurusan Takmir Masjid Baitussalam</h5>

            <div class="d-flex gap-4 overflow-auto pb-3">

                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Ketua Takmir</p>
                    <small class="text-muted">Bpk. Soleh</small>
                </div>

                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Wakil Takmir</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>

                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Sekretaris 1</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>

                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Bendahara</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>
                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Bendahara</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>
                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Bendahara</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>
                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Bendahara</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>
                <div class="text-center" style="min-width: 180px;">
                    <img src="assets/images/fotoProfile.jpg" class="rounded-4 mb-2"
                        style="width: 160px; height: 200px; object-fit: cover;">
                    <p class="fw-semibold mb-0">Bendahara</p>
                    <small class="text-muted">Bpk. Rohman</small>
                </div>

            </div>
        </div>



    </div>
</x-layout>
