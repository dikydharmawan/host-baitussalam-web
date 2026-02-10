<x-layout title="Laporan Keuangan | Baitussalam">
    <div>
        <div class="container laporanKeuanganContainer my-4">

            <a href="{{ route('dokumen') }}" class="text-decoration-none text-dark mb-3 d-inline-block">
                ← Kembali
            </a>

            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="fw-bold mb-1">Laporan Keuangan Masjid</h4>
                    <p class="text-muted mb-0">
                        Rekap laporan keuangan masjid per periode
                    </p>
                </div>

                @auth
                @if(auth()->user()->canManageDokumen())
                <a href="{{ route('unggahlaporankeuangan') }}" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i> Unggah Dokumen
                </a>
                @endif
                @endauth

            </div>

            <div class="card shadow-sm rounded-card p-4">

                <form method="GET" action="{{ route('laporankeuangan') }}"
                    class="d-flex flex-wrap mb-4 justify-content-between w-100 gap-3">

                    {{-- SEARCH --}}
                    <div class="input-group search-box" style="max-width:300px;">
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Judul laporan...">

                        <button type="submit" class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('search') || request('tahun'))
                        <a href="{{ route('laporankeuangan') }}"
                            class="btn btn-outline-secondary">
                            Reset
                        </a>
                        @endif
                    </div>

                    {{-- FILTER TAHUN --}}
                    <select name="tahun"
                        class="form-select w-auto"
                        onchange="this.form.submit()">

                        <option value="">Semua Tahun</option>

                        @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}"
                            {{ request('tahun') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                        @endfor
                    </select>

                </form>

                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Judul Laporan</th>
                                <th>Periode</th>
                                <th>Tanggal Upload</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporans as $laporan)
                            <tr>
                                <td>
                                    <strong>{{ $laporan->title }}</strong><br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y') }}
                                    </small>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::create()->month($laporan->periode_bulan)->translatedFormat('F') }}
                                    {{ $laporan->periode_tahun }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                                </td>

                                <td>{{ $laporan->uploaded_by }}</td>

                                <td class="text-center">

                                    <!-- LIHAT -->
                                    <a target="_blank"
                                        href="{{ route('lihatlaporankeuangan', $laporan->id) }}"
                                        class="btn btn-success btn-sm rounded-pill px-3">
                                        Lihat
                                    </a>

                                    @auth
                                    @if(auth()->user()->canManageDokumen())
                                    <!-- HAPUS -->
                                    <form action="{{ route('hapuslaporankeuangan', $laporan->id) }}"
                                        method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm rounded-pill px-3"
                                            onclick="return confirm('Hapus laporan?')">
                                            Hapus
                                        </button>
                                    </form>
                                    @endif
                                    @endauth

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada laporan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <div class="mt-3">
                        {{ $laporans->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layout>