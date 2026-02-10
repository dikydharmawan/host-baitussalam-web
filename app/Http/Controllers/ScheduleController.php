<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
    /* =========================================================
     * HALAMAN
     * ========================================================= */
    public function calendarPage()
    {
        return view('penjadwalan_masjid.penjadwalanPage');
    }

    public function kegiatanPage(Request $request)
    {
        $today = now()->toDateString();
        $category = $request->category;
        $query = Schedule::query();
        if ($category) {
            $query->where('category', $category);
        }
        $kegiatans = $query
            ->orderByRaw("CASE WHEN end_date >= ? THEN 0 ELSE 1 END", [$today])
            ->orderBy('date', 'asc')
            ->get();
        return view('kegiatan_masjid.kegiatanPage', compact('kegiatans'));
    }

    /* =========================================================
     * FULLCALENDAR
     * ========================================================= */
    public function getEvents()
    {
        return Schedule::all()->map(function ($s) {
            $startDate = Carbon::parse($s->date);
            $endDate = $s->end_date
                ? Carbon::parse($s->end_date)->addDay()
                : $startDate->copy()->addDay();
            return [
                'id' => $s->id,
                'title' => $s->title,
                'start' => $startDate->toDateString(),
                'end'   => $endDate->toDateString(),
                'extendedProps' => [
                    'status' => $s->status,
                ]
            ];
        });
    }

    /* =========================================================
     * AGENDA PER TANGGAL
     * ========================================================= */
    public function agendaByDate(Request $request)
    {
        return Schedule::where('date', '<=', $request->date)
            ->where(function ($q) use ($request) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', $request->date);
            })
            ->orderBy('start')
            ->get()
            ->map(function ($s) {
                return [
                    'id' => $s->id,
                    'title' => $s->title,
                    'category' => $s->category,
                    'location' => $s->location,
                    'start_time' => $s->start_time,
                    'end_time'   => $s->end_time,
                    'status'     => $s->status,
                ];
            });
    }

    /* =========================================================
     * FORM
     * ========================================================= */
    public function formKalender(Request $request, $id = null)
    {
        $schedule = $id ? Schedule::findOrFail($id) : new Schedule();
        if (!$id && $request->has('date')) {
            $schedule->date = $request->date;
        }
        return view('penjadwalan_masjid.edit', compact('schedule'));
    }
    public function formKegiatan($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('kegiatan_masjid.editPage', compact('schedule'));
    }

    /* =========================================================
     * STORE
     * ========================================================= */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        [$startDate, $endDate, $start, $end] = $this->buildDateTime($request);
        if ($end->lte($start)) {
            return back()->withErrors([
                'end_time' => 'Waktu selesai harus setelah waktu mulai'
            ])->withInput();
        }
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $tanggal = now()->format('Y-m-d');
            $random = Str::lower(Str::random(3)) . substr(time(), -2);
            $userId = Auth::id() ?? 'Takmir';
            $ext = $file->getClientOriginalExtension();
            $imageName = "{$tanggal}-{$random}-{$userId}.{$ext}";
            Storage::disk('public')->putFileAs('gambar_kegiatan', $file, $imageName);
        }
        Schedule::create([
            ...$data,
            'date' => $startDate,
            'end_date' => $endDate,
            'start' => $start,
            'end' => $end,
            'image' => $imageName,
            'location' => $request->location ?? 'Masjid Baitussalam',
            'created_by' => Auth::check() ? Auth::user()->name : 'Takmir',
        ]);
        return redirect()
            ->route('penjadwalan')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    /* =========================================================
     * UPDATE
     * ========================================================= */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $data = $this->validateData($request, true);
        [$startDate, $endDate, $start, $end] = $this->buildDateTime($request);

        if ($end->lte($start)) {
            return back()->withErrors([
                'end_time' => 'Waktu selesai harus setelah waktu mulai'
            ])->withInput();
        }
        if ($request->hasFile('image')) {
            if ($schedule->image && Storage::disk('public')->exists('gambar_kegiatan/' . $schedule->image)) {
                Storage::disk('public')->delete('gambar_kegiatan/' . $schedule->image);
            }
            $file = $request->file('image');
            $tanggal = now()->format('Y-m-d');
            $random = Str::lower(Str::random(3)) . substr(time(), -2);
            $userId = Auth::id() ?? 'Takmir';
            $ext = $file->getClientOriginalExtension();
            $filename = "{$tanggal}-{$random}-{$userId}.{$ext}";
            Storage::disk('public')->putFileAs('gambar_kegiatan', $file, $filename);

            $data['image'] = $filename;
        }
        $schedule->update([
            ...$data,
            'date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'start' => $start,
            'end' => $end,
            'location' => $request->location ?: $schedule->location,
        ]);
        return redirect()
            ->route('lihatkegiatan', $schedule->id)
            ->with('success', 'Agenda berhasil diupdate');
    }


    /* =========================================================
     * DELETE
     * ========================================================= */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        if ($schedule->image && Storage::disk('public')->exists('gambar_kegiatan/' . $schedule->image)) {
            Storage::disk('public')->delete('gambar_kegiatan/' . $schedule->image);
        }
        $schedule->delete();
        return redirect()
            ->route('agenda')
            ->with('success', 'Agenda dihapus');
    }

    /* =========================================================
     * DETAIL
     * ========================================================= */
    public function show($id)
    {
        $schedule = Schedule::with('items')->findOrFail($id);

        return view('kegiatan_masjid.lihatPage', compact('schedule'));
    }
    /* =========================================================
     * HELPERS
     * ========================================================= */
    private function validateData($request, $isUpdate = false)
    {
        return $request->validate(
        [
            'title' => 'required|max:25',
            'category' => 'required',
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'location' => 'nullable|max:150',
            'pemateri' => 'nullable|max:100',
            'description' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'title.required' => 'Nama kegiatan wajib diisi',
            'category.required' => 'Kategori wajib dipilih',
            'date.required' => 'Tanggal wajib diisi',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'end_time.date_format' => 'Format waktu tidak valid',
            'end_date.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai',
        ]
        );
    }
    private function buildDateTime($request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->date);
        $endDate = $request->end_date
            ? Carbon::createFromFormat('Y-m-d', $request->end_date)
            : $startDate->copy();
        $start = Carbon::createFromFormat(
            'Y-m-d H:i',
            $startDate->format('Y-m-d') . ' ' . $request->start_time
        );
        $end = Carbon::createFromFormat(
            'Y-m-d H:i',
            $endDate->format('Y-m-d') . ' ' . $request->end_time
        );
        return [$startDate, $endDate, $start, $end];
    }
}
