<x-layout title="Laporan detail | Baitussalam">
    <div>
        <div class="container my-4">

            <a href="{{ route('laporankeuangan')}}" class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Laporan Keuangan
            </a>

            <div class="card shadow-sm mt-3">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <h5 class="fw-bold fs-2 mb-1">
                            {{ strtoupper($laporan->title) }}
                        </h5>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-receipt fs-3 me-3"></i>
                        <h6 class="fw-bold mb-0">LAPORAN KEUANGAN</h6>
                    </div>

                    <div class="border rounded p-3 mb-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <small class="text-muted">Jenis File</small>
                                <div>
                                    {{ strtoupper($ext) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Periode</small>
                                <div>
                                    {{ \Carbon\Carbon::create()->month($laporan->periode_bulan)->translatedFormat('F') }}
                                    {{ $laporan->periode_tahun }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Dibuat Oleh</small>
                                <div>{{ $laporan->uploaded_by }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Ukuran File</small>
                                <div>{{ $size }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Tanggal Upload</small>
                                <div>{{ $laporan->created_at->format('d M Y') }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Status</small><br>
                                <span class="badge badge-final statuslaporan">Final</span>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded p-3 mb-4">
                        <h6 class="fw-bold">Ringkasan Laporan</h6>
                        <p class="mb-0">
                            {{ $laporan->description ?? '-' }}
                        </p>
                    </div>

                    <div class="text-center mb-3">
                        <a target="_blank"
                            href="{{ asset('storage/laporan_keuangan/'.$laporan->file) }}"
                            class="btn btn-success px-4">
                            <i class="bi bi-download me-2"></i>
                            Unduh Laporan ({{ strtoupper($ext) }} • {{ $size }})
                        </a>
                    </div>

                    <div class="text-muted small">
                        <strong>Catatan Admin:</strong>
                        Perubahan isi laporan dilakukan di luar website dan diunggah kembali
                        dalam bentuk file PDF.
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layout>