@php use Illuminate\Support\Facades\Storage; @endphp
<x-layout title="lihat Detail | Baitussalam">
    <div>
        <div class="container my-4">

            <a href="{{ route('kegiatan') }}" class="text-decoration-none text-dark mb-3 d-inline-block">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <h4 class="fw-bold mb-2">
                {{ ($schedule->title) }}
            </h4>

            <div class="mb-3">
                <span class="badge bg-secondary me-2">Kajian</span>
                <span class="badge badge-soft">Akan Datang</span>
            </div>

            <div class="row g-4">

                <div class="col-lg-8">

                    <div class="card shadow-soft p-3">

                        @php
                        $img = $schedule->image && Storage::disk('public')->exists('gambar_kegiatan/'.$schedule->image)
                        ? asset('storage/gambar_kegiatan/'.$schedule->image)
                        : 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae';
                        @endphp

                        <img src="{{ $img }}" class="img-fluid">

                        <h6 class="fw-bold">Deskripsi Kegiatan</h6>
                        <p>
                            {{ $schedule->description ?: 'Tidak ada Deskripsi' }}
                        </p>

                        @auth
                        @if(auth()->user()->canManageKegiatan())
                        <hr>
                        <h6 class="fw-bold">Tambah Rangkaian Acara</h6>
                        <form method="POST" action="{{ route('kegiatan.items.store', $schedule->id) }}">
                            @csrf

                            <div class="row g-2">

                                {{-- Waktu --}}
                                <div class="col-3">
                                    <input type="time"
                                        name="time"
                                        class="form-control @error('time') is-invalid @enderror"
                                        min="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}"
                                        max="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}"
                                        value="{{ old('time') }}"
                                        required>

                                    @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <input type="text"
                                        name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Agenda"
                                        value="{{ old('title') }}"
                                        required>

                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <input type="text"
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Keterangan"
                                        value="{{ old('description') }}">

                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-1">
                                    <button class="btn btn-success w-100" type="submit">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                        @endif
                        @endauth

                        <h6 class="fw-bold mt-4">Rangkaian Acara</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Waktu</th>
                                        <th>Agenda</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($schedule->items as $item)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->time)->format('H:i') }}
                                        </td>

                                        <td>
                                            {{ $item->title }}
                                        </td>

                                        <td class="d-flex justify-content-between align-items-center text-start">
                                            <span>{{ $item->description ?: '-' }}</span>

                                            @auth
                                            <form method="POST"
                                                action="{{ route('kegiatan.items.destroy', $item->id) }}"
                                                onsubmit="return confirm('Hapus rangkaian acara ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger ms-2">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @endauth
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-muted">
                                            Belum ada rangkaian acara
                                        </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="card shadow-soft info-card p-3 mb-3">

                        <h6 class="fw-bold mb-3">Informasi Kegiatan</h6>

                        {{-- Tanggal --}}
                        <p>
                            <i class="bi bi-calendar-event me-2"></i>

                            @php
                            $start = \Carbon\Carbon::parse($schedule->date);
                            $end = $schedule->end_date ? \Carbon\Carbon::parse($schedule->end_date) : null;
                            @endphp

                            @if(!$end || $start->isSameDay($end))
                            {{ $start->translatedFormat('l, d F Y') }}
                            @else
                            {{ $start->translatedFormat('d F Y') }}
                            -
                            {{ $end->translatedFormat('d F Y') }}
                            @endif
                        </p>


                        {{-- Waktu --}}
                        <p>
                            <i class="bi bi-clock me-2"></i>
                            {{ $schedule->start_time ?? '-' }} - {{ $schedule->end_time ?? '-' }} WIB
                        </p>

                        {{-- Lokasi --}}
                        <p>
                            <i class="bi bi-geo-alt me-2"></i>
                            {{ $schedule->location ?? '-' }}

                        </p>

                        {{-- Pemateri --}}
                        <p>
                            <i class="bi bi-person me-2"></i>
                            Pemateri : {{ $schedule->pemateri ?: '-' }}
                        </p>

                        <hr>

                        {{-- Kategori --}}
                        <p>
                            <i class="bi bi-tag me-2"></i>
                            Kategori :
                            <span class="badge badge-soft">
                                {{ $schedule->category ?? '-' }}
                            </span>
                        </p>

                        {{-- Dibuat oleh --}}
                        <p>
                            <i class="bi bi-person-check me-2"></i>
                            Dibuat Oleh : {{ $schedule->created_by ?: '-' }}
                        </p>

                        {{-- Terakhir diubah --}}
                        <p>
                            <i class="bi bi-pencil me-2"></i>
                            Terakhir Diubah :
                            {{ $schedule->updated_at ? $schedule->updated_at->translatedFormat('d F Y') : '-' }}
                        </p>

                        <a href="{{ route('penjadwalan') }}" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-calendar3 me-2"></i>Lihat Jadwal
                        </a>

                        @auth
                        @if(auth()->user()->canManageKegiatan())
                        <a href="{{ route('editkegiatan', $schedule->id) }}"
                            class="btn btn-outline-success w-100">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                        @endif
                        @endauth

                    </div>


                    <div class="card shadow-soft p-3">

                        <h6 class="fw-bold">Dokumen Terkait</h6>

                        <div class="d-flex justify-content-between align-items-center border rounded p-2 mt-2">

                            <div>
                                <strong>Proposal Kajian Subuh</strong>
                                <div class="text-muted small">10 Januari 2026</div>
                            </div>

                            <button class="btn btn-success btn-sm">
                                Unduh
                            </button>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</x-layout>