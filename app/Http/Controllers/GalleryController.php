<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        return view('galeri_masjid.galeriPage', [
            'idaroh'  => GalleryImage::where('section', 'idaroh')->latest()->take(3)->get(),
            'riayah'  => GalleryImage::where('section', 'riayah')->latest()->take(3)->get(),
            'imarah'  => GalleryImage::where('section', 'imarah')->latest()->take(3)->get(),
        ]);
    }

    public function berandaGaleri()
    {
        $galeri = [
            'idaroh' => GalleryImage::where('section', 'idaroh')->latest()->first(),
            'riayah' => GalleryImage::where('section', 'riayah')->latest()->first(),
            'imarah' => GalleryImage::where('section', 'imarah')->latest()->first(),
        ];
        return view('berandaPage', compact('galeri'));
    }

    public function show($section)
    {
        $images = GalleryImage::where('section', $section)->latest()->get();
        return view("galeri_masjid.{$section}Page", compact('images', 'section'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $folder = 'galeri/' . $data['section'];
        $file = $data['image'];

        $tanggal = now()->format('Y-m-d');
        $random = Str::lower(Str::random(3)) . substr(time(), -2);
        $userId = Auth::id();
        $ext = $file->getClientOriginalExtension();

        $namaFile = "{$tanggal}-{$random}-{$userId}.{$ext}";
        $path = $file->storeAs($folder, $namaFile, 'public');

        GalleryImage::create([
            'section'    => $data['section'],
            'image_path' => $path,
            'caption'    => $data['caption'],
            'user_id'    => $userId,
        ]);

        return back()->with('success', 'Gambar berhasil diupload.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION METHOD (Reusable)
    |--------------------------------------------------------------------------
    */
    private function validateData(Request $request, $isUpdate = false)
    {
        $fileRule = $isUpdate
            ? 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:8192|dimensions:min_width=300,min_height=300'
            : 'required|file|image|mimes:jpg,jpeg,png,webp|max:8192|dimensions:min_width=300,min_height=300';

        return $request->validate(
            [
                'image' => $fileRule,
                'caption' => [
                    'required',
                    'string',
                    'min:3',
                    'max:150',
                    'regex:/^[\pL\pN\s\-\.,()]+$/u',
                ],
                'section' => 'required|in:idaroh,imarah,riayah',
            ],
            [
                'image.required' => 'Gambar wajib diupload',
                'image.mimes' => 'Format harus JPG, PNG, WEBP',
                'image.max' => 'Ukuran maksimal 8MB',
                'image.dimensions' => 'Minimal resolusi 300x300',

                'caption.required' => 'Caption wajib diisi',
                'caption.regex' => 'Caption mengandung karakter tidak valid',
                'caption.min'=> 'Caption tidak boleh kurang dari 3 karakter',
                'caption.max' => 'Caption tidak boleh kurang dari 150 karakter',

                'section.required' => 'Section wajib dipilih',
            ]
        );
    }
}
