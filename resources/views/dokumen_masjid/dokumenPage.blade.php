<x-layout title="Dokumen Masjid | Baitussalm">
    <div>
        <div class="container my-5">

            <div class="mb-4">
                <h3 class="fw-bold mb-0">Dokumen Masjid</h3>
            </div>
            <hr>


            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="doc-card">
                        <i class="bi bi-bar-chart-fill doc-icon"></i>
                        <div>
                            <h6 class="fw-bold">Laporan Keuangan</h6>
                            <p>Dokumen laporan keuangan masjid yang sudah diarsipkan dalam format PDF.</p>
                        </div>
                        <a href="{{ route('laporankeuangan') }}" class="doc-action">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="doc-card">
                        <i class="bi bi-clipboard-data doc-icon"></i>
                        <div>
                            <h6 class="fw-bold">Laporan Kegiatan</h6>
                            <p>Dokumen laporan kegiatan masjid yang sudah diarsipkan dalam format PDF.</p>
                        </div>
                        <a href="#" class="doc-action">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="doc-card">
                        <i class="fa-solid fa-scale-balanced doc-icon"></i>
                        <div>
                            <h6 class="fw-bold">AD / ART</h6>
                            <p>Dokumen resmi Anggaran Dasar dan Anggaran Rumah Tangga masjid dalam format PDF.</p>
                        </div>
                        <a href="{{ route('adartlaporan') }}" class="doc-action">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold">Arsip Surat</h5>
            <p class="text-muted mb-4">
                Arsip surat masuk, surat keluar, dan <em>template</em> surat masjid.
            </p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="doc-card">
                        <i class="bi bi-envelope-fill doc-icon"></i>
                        <div>
                            <h6 class="fw-bold">Surat Masuk</h6>
                            <p>Daftar surat yang diterima oleh masjid</p>
                        </div>
                        <a href="#" class="doc-action">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="doc-card">
                        <i class="bi bi-send-fill doc-icon"></i>
                        <div>
                            <h6 class="fw-bold">Surat Keluar</h6>
                            <p>Daftar surat yang dikirim oleh masjid</p>
                        </div>
                        <a href="#" class="doc-action">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="doc-card">
                        <i class="bi bi-file-earmark-text-fill doc-icon"></i>
                        <div>
                            <h6 class="fw-bold">Template Surat</h6>
                            <p>Template surat resmi untuk berbagai keperluan</p>
                        </div>
                        <a href="#" class="doc-action">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr>

        </div>
    </div>
</x-layout>
