<x-layout title="Donasi | Baitussalam">
    <div>
        <div class="container my-5">

            <div class="row cardHeroDonasi align-items-center mb-4">
                <div class="col-lg-6">
                    <h2 class="fw-bold">Ayo Berdonasi<br>Untuk Masjid</h2>
                    <p class="text-muted">
                        Anda dapat berdonasi melalui QRIS atau transfer rekening resmi masjid.
                    </p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <img src="assets/images/gambarMasjid.png" class="img-fluid rounded-4 heroImgDonasi">
                </div>
            </div>

            <div class="card cardQris rounded-4 border-0 mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-1">Scan QRIS untuk Donasi</h6>
                            <small class="text-muted d-block mb-3">
                                Bisa dipakai semua e-wallet & m-banking
                            </small>
                            <a href="#" class="btn btnDownloadQris badge py-3 px-3 fw-light">
                                Download QR
                            </a>
                        </div>
                        <div class="col-md-6 text-center mt-3 mt-md-0">
                            <img src="assets/images/qris.png" class="img-fluid qrisImgDonasi">
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-2">Rekening Bank</h6>
            <div class="card cardBank rounded-4 border-0 mb-4">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">

                    <div class="d-flex align-items-center gap-3">
                        <img src="assets/images/logoBCA.png" width="40">
                        <div>
                            <div class="fw-semibold">BCA</div>
                            <small class="text-muted">Samsudin</small>
                        </div>
                    </div>

                    <div>
                        <small class="text-muted">Nomor Rekening</small>
                        <div class="fw-bold">1234 5678 9012</div>
                        <small class="text-muted">An. Masjid Mubarokah</small>
                    </div>

                    <button class="btn btnCopyDonasi badge py-3 px-3 fw-light">
                        Copy
                    </button>

                </div>
            </div>

            <div>
                <h6 class="fw-bold">Catatan Penting</h6>
                <small class="text-muted">
                    Semua donasi akan digunakan untuk kemakmuran masjid
                </small>
            </div>

        </div>
    </div>
</x-layout>
