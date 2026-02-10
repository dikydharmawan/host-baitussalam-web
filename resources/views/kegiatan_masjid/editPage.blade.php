<x-layout title="Edit detail kegiatan">
    <div class="container my-4">

        <a href="{{ route('lihatkegiatan', $schedule->id) }}"
            class="text-decoration-none text-dark mb-3 d-inline-block">
            ← Kembali
        </a>

        <div class="card shadow-soft p-4">

            <h5 class="fw-bold">Edit Detail Kegiatan</h5>
            <p class="text-muted mb-4">Khusus takmir</p>

            @auth
            @if(auth()->user()->canManageKegiatan())
            <form action="{{ route('updatekegiatan', $schedule->id) }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- HIDDEN FIELD (WAJIB kalau tidak ditampilkan di form) --}}
                <input type="hidden" name="date"
                    value="{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') }}">

                <input type="hidden" name="end_date"
                    value="{{ optional($schedule->end_date)->format('Y-m-d') }}">

                <input type="hidden" name="start_time"
                    value="{{ \Carbon\Carbon::parse($schedule->start)->format('H:i') }}">

                <input type="hidden" name="end_time"
                    value="{{ \Carbon\Carbon::parse($schedule->end)->format('H:i') }}">


                <div class="row g-4">

                    {{-- KOLOM KIRI --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $schedule->title) }}">

                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category" class="form-select">
                                <option value="Kajian" {{ $schedule->category=='Kajian'?'selected':'' }}>Kajian</option>
                                <option value="Pelatihan" {{ $schedule->category=='Pelatihan'?'selected':'' }}>Pelatihan</option>
                                <option value="Kegiatan Sosial" {{ $schedule->category=='Kegiatan Sosial'?'selected':'' }}>Kegiatan Sosial</option>
                                <option value="Rutin" {{ $schedule->category=='Rutin'?'selected':'' }}>Rutin</option>
                                <option value="Acara Besar" {{ $schedule->category=='Acara Besar'?'selected':'' }}>Acara Besar</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $schedule->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pemateri</label>
                            <input type="text" name="pemateri" class="form-control"
                                value="{{ old('pemateri', $schedule->pemateri) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $schedule->location) }}">

                            @error('location')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="col-md-6">
                        <div class="border rounded p-3 text-center">

                            <div id="preview"
                                class="d-flex align-items-center justify-content-center border rounded"
                                style="height:220px;cursor:pointer;background:#f8f9fa;"
                                onclick="document.getElementById('imageInput').click()">

                                <div class="text-center text-muted">
                                    <div style="font-size:40px;">＋</div>
                                    <small>Upload gambar (Opsional)</small>
                                </div>
                            </div>
                                <br>
                            <input type="file" id="imageInput" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- TOMBOL --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('lihatkegiatan', $schedule->id) }}"
                        class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>

            </form>
            @endif
            @endauth

        </div>
    </div>
</x-layout>