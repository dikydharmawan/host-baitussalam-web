<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ScheduleItemController extends Controller
{
    /* =========================================================
     * STORE (TAMBAH RANGKAIAN)
     * ========================================================= */
    public function store(Request $request, $scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        $data = $this->validateData($request, $schedule);

        $this->validateTimeRange($schedule, $data['time']);

        ScheduleItem::create([
            'schedule_id' => $schedule->id,
            'time' => $data['time'],
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        return back()->with('success', 'Rangkaian acara ditambahkan');
    }

    /* =========================================================
     * DELETE
     * ========================================================= */
    public function destroy($id)
    {
        $item = ScheduleItem::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Rangkaian acara dihapus');
    }

    /* =========================================================
     * HELPERS (KHUSUS ITEM)
     * ========================================================= */

    private function validateData(Request $request, Schedule $schedule)
    {
        return $request->validate([
            'time' => [
                'required',
                'date_format:H:i',

                Rule::unique('schedule_items', 'time')
                    ->where('schedule_id', $schedule->id),
            ],

            'title' => ['required', 'string', 'max:150'],

            'description' => ['nullable', 'string', 'max:255'],
        ], 
[
            'time.unique' => 'Jam ini sudah digunakan di rangkaian acara.',
            'time.required' => 'Waktu wajib diisi.',
            'title.required' => 'Agenda wajib diisi.',
            'title.max' => 'Agenda maksimal 150 karakter.',
            'description.max' => 'Keterangan maksimal 255 karakter.',
        ]
        
        );
    }

    private function validateTimeRange(Schedule $schedule, string $time)
    {
        $start = Carbon::parse($schedule->start_time)->format('H:i');
        $end   = Carbon::parse($schedule->end_time)->format('H:i');

        if ($time < $start || $time > $end) {
            return back()
                ->withErrors([
                    'time' => 'Jam harus di antara ' . $start . ' - ' . $end
                ])
                ->withInput()
                ->throwResponse();
        }
    }
}
