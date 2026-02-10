<x-layout title="Edit Penjadwalan | Baitussalam">
    @auth
    @if(auth()->user()->canManagePenjadwalan())
    <div class="container my-4">

        <a href="{{ route('penjadwalan') }}" class="text-decoration-none text-dark mb-3 d-inline-block">
            ← Kembali ke Halaman Penjadwalan
        </a>

        <div class="card shadow-sm rounded-4 p-4">
            <h4 class="fw-bold mb-1">
                {{ $schedule->id ? 'Edit Jadwal Kegiatan' : 'Tambah Jadwal Kegiatan' }}
            </h4>
            <p class="text-muted mb-4">Hanya dapat diakses oleh takmir</p>

            {{-- FORM UTAMA (SATU-SATUNYA FORM) --}}
            <form method="POST"
                action="{{ $schedule->id 
                    ? route('penjadwalan.update', $schedule->id) 
                    : route('penjadwalan.store') }}">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @csrf
                @if($schedule->id)
                @method('PUT')
                @endif

                <div class="row g-4">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" name="title"
                                class="form-control rounded-3 @error('title') is-invalid @enderror"
                                value="{{ old('title', $schedule->title) }}">

                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category" class="form-select rounded-3">
                                @foreach(['Kajian','Pelatihan','Kegiatan Sosial','Rutin','Acara Besar'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('category', $schedule->category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="date" value="{{ $schedule->date->format('Y-m-d') }}">
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control"
                                value="{{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d F Y') }}"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Berakhir (Opsional)</label>
                            <input type="date" name="end_date"
                                class="form-control"
                                value="{{ old('end_date', $schedule->end_date?->format('Y-m-d')) }}">
                            <small class="text-muted">
                                Ubah jika acara lebih dari 1 hari
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="location"
                                class="form-control rounded-3 @error('title') is-invalid @enderror"
                                value="{{ old('location', $schedule->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <label class="form-label">Waktu</label>
                        <div class="d-flex gap-3 mb-3">
                            <input type="time" name="start_time"
                                class="form-control rounded-3 @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time', $schedule->start_time) }}">

                            <input type="time" name="end_time"
                                class="form-control rounded-3 @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time', $schedule->end_time) }}">

                        </div>


                    </div>

                    {{-- BUTTON ACTION --}}
                    <div class="col-12 d-flex justify-content-end gap-3 mt-3">

                        <button type="submit"
                            class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
                            Simpan
                        </button>

                        @if($schedule->id)
                        <button type="button"
                            class="btn btn-danger px-4 py-2 rounded-pill shadow-sm"
                            onclick="deleteSchedule('{{ $schedule->id }}')">
                            Hapus
                        </button>
                        @endif

                        <a href="{{ route('penjadwalan') }}"
                            class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                            Batal
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- DELETE VIA AJAX (AMAN, TANPA NESTED FORM) --}}
    @if($schedule->id)
    <script>
        function deleteSchedule(id) {
            if (!confirm('Yakin hapus jadwal ini?')) return;

            fetch(`/penjadwalan/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                })
                .then(res => res.json())
                .then(() => {
                    window.location.href = "{{ route('penjadwalan') }}";
                });
        }
    </script>
    @endif
    @endif
    @endauth
</x-layout>