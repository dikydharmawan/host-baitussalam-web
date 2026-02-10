<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialReport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $year   = $request->tahun;
        $search = $request->search;
        $query = FinancialReport::query();
        if ($year) {
            $query->where('periode_tahun', $year);
        }
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }
        $laporans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view(
            'dokumen_masjid.laporan_keuangan.laporankeuanganPage',
            compact('laporans', 'year', 'search')
        );
    }


    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $file = $request->file('file');

        $filename = now()->format('Y-m-d') . '-' .
            Str::random(5) . '.' .
            $file->getClientOriginalExtension();

        $file->storeAs('laporan_keuangan', $filename, 'public');

        FinancialReport::create([
            'title' => strip_tags($validated['title']),
            'description' => strip_tags($validated['description'] ?? ''),
            'periode_bulan' => $validated['periode_bulan'],
            'periode_tahun' => $validated['periode_tahun'],
            'file' => $filename,
            'uploaded_by' => Auth::user()->name ?? 'Takmir',
        ]);

        return redirect()
            ->route('laporankeuangan')
            ->with('success', 'Laporan berhasil diupload');
    }


    public function update(Request $request, $id)
    {
        $report = FinancialReport::findOrFail($id);
        $validated = $this->validateData($request, true);
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete('laporan_keuangan/' . $report->file);
            $file = $request->file('file');
            $filename = now()->format('Y-m-d') . '-' . Str::random(5) . '.' .
                $file->getClientOriginalExtension();
            $file->storeAs('laporan_keuangan', $filename, 'public');
            $report->file = $filename;
        }
        $report->update($validated);
        return back()->with('success', 'Laporan diupdate');
    }

    public function show($id)
    {
        $laporan = FinancialReport::findOrFail($id);
        $path = 'laporan_keuangan/' . $laporan->file;
        $fullPath = storage_path('app/public/' . $path);
        $size = file_exists($fullPath)
            ? round(filesize($fullPath) / 1024 / 1024, 2) . ' MB'
            : '-';
        $ext = strtolower(pathinfo($laporan->file, PATHINFO_EXTENSION));
        return view(
            'dokumen_masjid.laporan_keuangan.lihatPage',
            compact('laporan', 'size', 'ext')
        );
    }

    public function destroy($id)
    {
        $report = FinancialReport::findOrFail($id);
        if ($report->file && Storage::disk('public')->exists('laporan_keuangan/' . $report->file)) {
            Storage::disk('public')->delete('laporan_keuangan/' . $report->file);
        }
        $report->delete();
        return back()->with('success', 'Laporan dihapus');
    }

    private function validateData(Request $request, $isUpdate = false)
    {
        $fileRule = $isUpdate
            ? 'nullable|file|mimes:pdf,xlsx,xls,doc,docx|max:10240'
            : 'required|file|mimes:pdf,xlsx,xls,doc,docx|max:10240';
        return $request->validate(
            [
                'title' => 'required|max:150',
                'periode_bulan' => 'required|integer|min:1|max:12',
                'periode_tahun' => 'required|integer|min:2020|max:2100',
                'description' => 'nullable|max:500',
                'file' => $fileRule,
            ],
            [
                'title.required' => 'Judul laporan wajib diisi',
                'periode_bulan.required' => 'Pilih bulan laporan',
                'periode_tahun.required' => 'Pilih tahun laporan',
                'file.required' => 'File wajib diupload',
                'file.mimes' => 'Format file harus PDF/Excel/Word',
                'file.max' => 'Ukuran maksimal 10MB',
            ]
        );
    }
}
