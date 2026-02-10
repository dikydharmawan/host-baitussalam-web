<x-layout title="Unggah Laporan | Baitussalam">
    <div>
        <div class="container my-5">
            <a href="{{ route('laporankeuangan')}}" class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Laporan Keuangan
            </a>
            <h4 class="fw-bold mb-4">Unggah Dokumen Laporan Keuangan</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('storelaporankeuangan') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ALERT SUCCESS --}}
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- ALERT ERROR --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row g-4">

                            <div class="col-md-6">
                                {{-- JUDUL --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Judul Laporan</label>
                                    <input type="text" name="title"
                                        value="{{ old('title') }}"
                                        class="form-control shadow-sm @error('title') is-invalid @enderror">

                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- PERIODE --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Periode</label>

                                    <select name="periode_bulan"
                                        class="form-select shadow-sm @error('periode_bulan') is-invalid @enderror">
                                        <option value="">Pilih bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('periode_bulan') == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                            @endfor
                                    </select>

                                    <select name="periode_tahun"
                                        class="form-select shadow-sm mt-2 @error('periode_tahun') is-invalid @enderror">
                                        @for ($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}" {{ old('periode_tahun') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                        @endfor
                                    </select>
                                </div>

                                {{-- DESKRIPSI --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi</label>
                                    <textarea name="description"
                                        class="form-control shadow-sm">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            {{-- UPLOAD --}}
                            <div class="col-md-6 uploadboxcontainer">
                                <label class="form-label fw-semibold">Unggah Dokumen</label>

                                <div class="upload-box mb-2">
                                    <i class="bi bi-cloud-arrow-up upload-icon"></i>

                                    <p class="mt-2 mb-1 text-muted" id="fileNameText">
                                        Tidak ada file yang dipilih
                                    </p>

                                    <small class="text-muted" id="fileSizeText"></small>

                                    <input type="file" name="file"
                                        class="d-none @error('file') is-invalid @enderror"
                                        id="fileInput">

                                    <label for="fileInput" class="btn btn-outline-secondary btn-sm">
                                        Pilih File
                                    </label>

                                    @error('file')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <small class="text-muted d-block mb-3">
                                    Maksimal 10MB (PDF, Excel, Word)
                                </small>

                                <button type="submit" class="btn btn-upload w-100">
                                    Unggah Dokumen
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById("fileInput");
            const nameText = document.getElementById("fileNameText");
            const sizeText = document.getElementById("fileSizeText");

            input.addEventListener("change", function() {

                if (this.files.length > 0) {
                    let file = this.files[0];

                    let ext = file.name.split('.').pop().toLowerCase();
                    let icon = "📄";

                    if (ext === "pdf") icon = "📕";
                    if (ext === "xls" || ext === "xlsx") icon = "📊";
                    if (ext === "doc" || ext === "docx") icon = "📝";

                    nameText.textContent = icon + " " + file.name;

                    let size = file.size / 1024 / 1024;
                    sizeText.textContent = "Ukuran: " + size.toFixed(2) + " MB";

                    nameText.classList.remove("text-muted");
                    nameText.classList.add("text-success");
                }
            });
        });
    </script>

</x-layout>