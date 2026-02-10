<x-layout title="Kegiatan | Baitussalam">
    <div>
        <div class="container my-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="{{ route('beranda') }}" class="text-decoration-none text-dark">←<span class="fw-bold ms-2">Kembali</span>
                    </a>
                </div>
            </div>

            <div class="mb-4" id="fiterKegiatan">
                <div class="btn-group fiterKegiatanMenu rounded-pill p-2">

                    <a href="{{ route('kegiatan') }}"
                        class="btn rounded-pill btn-sm px-3 {{ request('category') == null ? 'btn-dark text-white' : '' }}">
                        Semua
                    </a>

                    <a href="{{ route('kegiatan', ['category' => 'Rutin']) }}"
                        class="btn rounded-pill btn-sm px-3 {{ request('category') == 'Rutin' ? 'btn-dark text-white' : '' }}">
                        Rutin
                    </a>

                    <a href="{{ route('kegiatan', ['category' => 'Kajian']) }}"
                        class="btn rounded-pill btn-sm px-3 {{ request('category') == 'Kajian' ? 'btn-dark text-white' : '' }}">
                        Kajian
                    </a>

                    <a href="{{ route('kegiatan', ['category' => 'Acara Besar']) }}"
                        class="btn rounded-pill btn-sm px-3 {{ request('category') == 'Acara Besar' ? 'btn-dark text-white' : '' }}">
                        Acara Besar
                    </a>

                    <a href="{{ route('kegiatan', ['category' => 'Pelatihan']) }}"
                        class="btn rounded-pill btn-sm px-3 {{ request('category') == 'Pelatihan' ? 'btn-dark text-white' : '' }}">
                        Pelatihan
                    </a>

                    <a href="{{ route('kegiatan', ['category' => 'Kegiatan Sosial']) }}"
                        class="btn rounded-pill btn-sm px-3 {{ request('category') == 'Kegiatan Sosial' ? 'btn-dark text-white' : '' }}">
                        Kegiatan Sosial
                    </a>

                </div>
            </div>

            <div class="row g-4">

                @forelse($kegiatans as $k)
                <div class="col-lg-4 col-md-6">
                    <div class="card cardKegiatan h-100 border rounded-4">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="rounded-pill fw-normal badgeKegiatan temaKegiatan">
                                    {{ strtoupper($k->category) }}
                                </span>
                                <span class="rounded-pill badgeKegiatan fw-normal statusKegiatan">
                                    {{ $k->status }}
                                </span>
                            </div>

                            <div class="d-flex gap-3">
                                <img src="{{ asset('assets/images/logobaitussalam.png') }}" class="rounded-3 shadow-sm" width="60" height="60"
                                    style="object-fit:cover">

                                <div>
                                    <h6 class="fw-bold mb-1">{{ $k->title }}</h6>

                                    {{-- Pemateri --}}
                                    <small class="text-muted d-block">
                                        <i class="bi bi-person me-2"></i>
                                        {{ $k->pemateri ?? '-' }}
                                    </small>

                                    {{-- Tanggal --}}
                                    <small class="text-muted d-block">
                                        <i class="bi bi-calendar"></i> {{ $k->date_label }}
                                    </small>

                                    {{-- Waktu --}}
                                    <small class="text-muted d-block">
                                        <i class="bi bi-clock"></i>
                                        {{ $k->start_time }} - {{ $k->end_time }} WIB
                                    </small>

                                    {{-- Lokasi --}}
                                    <small class="text-muted d-block">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $k->location ?? '-' }}
                                    </small>
                                </div>
                            </div>


                            <div class="mt-3 d-flex gap-2">

                                <a href="{{ route('lihatkegiatan', $k->id) }}"
                                    class="btn detailButtonKegiatan w-100 rounded-pill">
                                    Lihat Detail
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                @empty
                {{-- kosong --}}
                @endforelse

            </div>
            @if($kegiatans->count() == 0)
            <div class="border rounded-4 text-center p-4 mt-5 text-muted">
                <i class="bi bi-calendar-x fs-2"></i>
                <p class="fw-semibold mt-2 mb-0">Belum ada kegiatan</p>
                <small>Silahkan cek kembali nanti</small>
            </div>
            @endif

        </div>
    </div>
</x-layout>