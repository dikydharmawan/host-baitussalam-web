<x-layout title="Penjadwalan | Baitussalam">
    <div class="container my-5">

        <h3 class="fw-bold mb-3">Penjadwalan Masjid</h3>

        <div class="card shadow-sm border-0 p-4">

            <div class="row g-4">

                <div class="col-lg-7">
                    <div id="calendar" class="calendar-box"></div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-sm rounded-4">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <h5 class="fw-bold mb-0">Agenda Masjid</h5>

                                @auth
                                @if(auth()->user()->canManagePenjadwalan())
                                <a href="javascript:void(0)"
                                    onclick="goToCreateAgenda()"
                                    class="btn btn-success btn-sm rounded-pill px-3">
                                    + Tambah Agenda
                                </a>
                                @endif
                                @endauth
                            </div>
                            <p class="text-muted small mb-3">
                                Tanggal: <strong id="agendaDateLabel">-</strong>
                            </p>
                            <div id="agendaList"></div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <script>
            let selectedDate = new Date().toISOString().slice(0, 10);
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const agendaList = document.getElementById('agendaList');

                const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    editable: false,

                    events: '/penjadwalan/events',

                    dateClick: function(info) {
                        selectedDate = info.dateStr;

                        loadAgendaByDate(info.dateStr);
                        updateAgendaTitle(info.dateStr);
                    }
                });

                calendar.render();
                setInterval(() => {
                    loadAgendaByDate(selectedDate);
                }, 1200000); // 120 detik

                // load hari ini pertama kali
                const today = new Date().toISOString().slice(0, 10);
                loadAgendaByDate(today);
                updateAgendaTitle(today);

                function loadAgendaByDate(date) {
                    agendaList.innerHTML = '<p class="text-muted">Memuat agenda...</p>';

                    fetch(`/penjadwalan/agenda?date=${date}`)
                        .then(res => res.json())
                        .then(data => {

                            agendaList.innerHTML = '';

                            if (data.length === 0) {
                                agendaList.innerHTML = `
                        <p class="text-muted">Tidak ada agenda di tanggal ini.</p>
                    `;
                                return;
                            }

                            data.forEach(a => {
                                agendaList.innerHTML += agendaCardTemplate(a);
                            });
                        });
                }

                function updateAgendaTitle(dateStr) {
                    const el = document.querySelector('#agendaDateLabel');
                    if (!el) return;

                    const d = new Date(dateStr);
                    el.innerText = d.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                }

                function agendaCardTemplate(a) {
                    return `
                        <div class="agenda-item mb-3 border-bottom pb-3">
                        @auth
                        @if(auth()->user()->canManagePenjadwalan())
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="fw-semibold mb-0">${a.title}</h6>
                                <div>
                                    <a class="btn btn-outline-success btn-sm rounded-pill px-3 me-1"
                                    href="/penjadwalan/edit/${a.id}">
                                        Edit
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                            onclick="deleteAgenda(${a.id})">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        @endif
                        @endauth
                            <div class="agenda-info text-muted small">
                                <div class="mb-1">
                                    <i class="bi bi-clock me-1"></i>
                                    ${a.start_time} - ${a.end_time}
                                </div>
                                <div class="mb-1">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    ${a.location}
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-success-subtle text-success px-3 rounded-pill">
                                            ${a.category}
                                    </span>

                                    <span class="badge ${getStatusBadgeClass(a.status)} px-3 rounded-pill">
                                            ${a.status}
                                    </span>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <a href="/penjadwalan/lihat/${a.id}"
                                class="btn btn-success btn-sm rounded-pill px-4">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        `;
                }

                function getStatusBadgeClass(status) {
                    switch (status) {
                        case 'Hari Ini':
                            return 'bg-success text-white';
                        case 'Akan Datang':
                            return 'bg-primary text-white';
                        case 'Selesai':
                            return 'bg-secondary text-white';
                        default:
                            return 'bg-light text-dark';
                    }
                }

            });
        </script>

        <script>
            function deleteAgenda(id) {
                if (!confirm('Yakin hapus agenda ini?')) return;

                fetch(`/penjadwalan/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(res => res.json())
                    .then(() => {
                        const currentDate = document.getElementById('agendaDateLabel').innerText;
                        location.reload();
                    });
            }
        </script>

        <script>
            function goToCreateAgenda() {
                if (!selectedDate) {
                    alert('Silakan pilih tanggal di kalender dulu');
                    return;
                }

                window.location.href = `/penjadwalan/create?date=${selectedDate}`;
            }
        </script>

    </div>

</x-layout>