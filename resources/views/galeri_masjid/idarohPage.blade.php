<x-layout title="Idaroh | Baitussalam">
    <div>
        <div class="container my-4">
            <a href="{{ route('galeri') }}" class="text-decoration-none text-muted small mb-2 d-inline-block">
                ← Kembali ke Galeri
            </a>
            <h4 class="fw-bold mt-2">
                IDAROH (Manajemen dan Administrasi)
            </h4>

            <p class="text-muted">
                Bidang IDAROH (Manajemen dan Administrasi) bertugas dalam mengelola administrasi,
                keuangan, dan perencanaan kegiatan di Masjid Baitussalam, termasuk pembinaan SDM
                dan pengaturan program-program masjid Baitussalam.
            </p>

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
                    Mengelola administrasi dan keuangan masyarakat
                </li>
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Menyusun rencana program tahunan masjid
                </li>
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Pembinaan dan pelatihan bagi pengurus masjid
                </li>
                <li class="mb-2">
                    <i class="bi bi-star-fill text-success me-2"></i>
                    Mengatur inventaris dan logistik masjid
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

                    <div class="mb-3">
                        <input type="file" name="image"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" name="caption"
                            class="form-control @error('caption') is-invalid @enderror"
                            placeholder="Nama / Keterangan gambar"
                            value="{{ old('caption') }}">

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
