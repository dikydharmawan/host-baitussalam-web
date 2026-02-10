<x-layout title="Imarah | Baitussalam">
    <div>
        <div class="container my-4">

            <a href="{{ route('galeri') }}" class="text-decoration-none text-muted small mb-2 d-inline-block">
                ← Kembali ke Galeri
            </a>

            <h4 class="fw-bold mt-2">
                IMARAH ( Kegiatan Keagamaan dan Dakwah )
            </h4>

            <p class="text-muted">
                Bidang Imarah berfokus pada penyelenggaraan kegiatan keagamaan, dakwah, dan pembinaan jamaah guna
                meningkatkan keimanan, ketakwaan, serta mempererat ukhuwah islamiyah di ingkungan masjid.
            </p>

            <div class="section-divider"></div>

            <div class="accordion mt-4" id="imarahAccordion">

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#itemOne">
                            <i class="bi bi-people-fill me-2"></i> Pembinaan Jamaah
                        </button>
                    </h2>
                    <div id="itemOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <p class="small text-muted">
                                Kegiatan pembinaan yang ditujukan bagi jamaah dari berbagai kalangan
                                untuk meningkatkan pemahaman dan pengamalan ajaran Islam.
                            </p>

                            <strong class="small">Contoh Kegiatan :</strong>
                            <div class="row mt-2 small">
                                <div class="col-md-6">
                                    <ul>
                                        <li>Pengajian rutin</li>
                                        <li>Pengajian tematik</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li>Kajian tematik</li>
                                        <li>Pembinaan akhlak dan ibadah</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#itemTwo">
                            <i class="bi bi-megaphone-fill me-2"></i> Pendidikan dan Dakwah
                        </button>
                    </h2>
                    <div id="itemTwo" class="accordion-collapse collapse">
                        <div class="accordion-body small text-muted">
                            Kegiatan dakwah, ceramah, dan pendidikan keislaman bagi masyarakat.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#itemThree">
                            <i class="bi bi-moon-stars-fill me-2"></i> Kegiatan Hari Besar Islam
                        </button>
                    </h2>
                    <div id="itemThree" class="accordion-collapse collapse">
                        <div class="accordion-body small text-muted">
                            Penyelenggaraan peringatan hari besar Islam seperti Maulid Nabi,
                            Isra Mi’raj, dan Ramadhan.
                        </div>
                    </div>
                </div>

            </div>

            <div class="section-divider"></div>

            <h6 class="fw-semibold mb-3">Galeri Foto</h6>

            <div class="row g-4" id="galleryGrid">

                @foreach($images as $img)
                <div class="col-md-3 col-sm-6">
                    <div class="gallery-card">
                        <img src="{{ asset('storage/'.$img->image_path) }}" class="w-100 gallery-img">

                        <p class="text-muted mb-0">{{ $img->caption }}</p>

                        @auth
                        @if(auth()->user()->canManageGallery())
                        <small class="text-muted">
                            Diupload Oleh {{ optional($img->user)->name ?? 'Takmir' }}
                        </small>
                        @endif
                        @endauth
                    </div>
                </div>
                @endforeach

                {{-- SLOT + --}}
                @auth
                @if(auth()->user()->canManageGallery())
                <div class="col-md-3 col-sm-6">
                    <div class="gallery-card gallery-add" onclick="openUploadForm()">
                        <div class="gallery-plus">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                    </div>
                </div>
                @endif
                @endauth

            </div>

            <div class="section-divider"></div>

            <h6 class="fw-semibold mb-3">Kegiatan Utama</h6>

            <ul class="list-unstyled">
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Perawatan bangunan masjid
                </li>
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Kebersihan dan Sanitasi
                </li>
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Keamanan dan fasilitas
                </li>
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Pengelolaan inventantaris fisik
                </li>
            </ul>
            @auth
            @if(auth()->user()->canManageGallery())
            <div class="d-flex justify-content-end mt-4">
                <button class="btn btn-success rounded-pill px-4 " onclick="openUploadForm()">
                    <i class="bi bi-plus-circle me-1"></i> Unggah Gambar
                </button>
            </div>
            @endif
            @endauth

            <hr>

        </div>
    </div>

    @auth
    @if(auth()->user()->canManageGallery())
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('galeri.upload') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <input type="hidden" name="section" value="{{ $section }}">

                <div class="modal-header">
                    <h5 class="modal-title">Upload Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- ERROR KHUSUS MODAL --}}
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Upload gagal!</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- FILE --}}
                    <div class="mb-3">
                        <input type="file" name="image"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- CAPTION --}}
                    <div class="mb-3">
                        <input type="text"
                            name="caption"
                            value="{{ old('caption') }}"
                            placeholder="Nama / Keterangan gambar"
                            class="form-control @error('caption') is-invalid @enderror">

                        @error('caption')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        ✖ Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        ✔ Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openUploadForm() {
            const el = document.getElementById('uploadModal');
            if (!el) return;
            const modal = new bootstrap.Modal(el);
            modal.show();
        }
    </script>

    @if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            openUploadForm();
        });
    </script>
    @endif

    @endif
    @endauth

</x-layout>