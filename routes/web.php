<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Beranda & Auth
|--------------------------------------------------------------------------
*/

Route::get('/', [GalleryController::class, 'berandaGaleri'])->name('beranda');

Route::post('/login', [AuthController::class, 'login'])
  ->middleware('throttle:5,1')
  ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', fn() => view('profilePage'))->name('profile');
Route::get('/kontak',  fn() => view('kontakPage'))->name('kontak');


/*
|--------------------------------------------------------------------------
| Layanan Masjid
|--------------------------------------------------------------------------
*/
Route::prefix('layanan Masjid')->group(function () {

  Route::get('/zakatinfaq', fn() => view('layanan_masjid/zakatPage'))
    ->name('zakatinfaq');

  Route::get('/literasikeagamaan', fn() => view('layanan_masjid/literasiPage'))
    ->name('literasikeagamaan');

  Route::get('/peminjamanfasilitas', fn() => view('layanan_masjid/peminjamanPage'))
    ->name('peminjamanfasilitas');
});

/*
|--------------------------------------------------------------------------
| Penjadwalan Masjid
|--------------------------------------------------------------------------
*/
Route::prefix('penjadwalan')->group(function () {
  Route::get('/', [ScheduleController::class, 'calendarPage'])->name('penjadwalan');
  Route::get('/events', [ScheduleController::class, 'getEvents']);
  Route::get('/agenda', [ScheduleController::class, 'agendaByDate']);
  Route::get('/lihat/{id}', [ScheduleController::class, 'show'])->name('penjadwalan.show');
});

Route::middleware('auth')->prefix('penjadwalan')
->group(function () {

    Route::get('/create', [ScheduleController::class, 'formKalender'])
      ->name('penjadwalan.create');

    Route::get('/edit/{id}', [ScheduleController::class, 'formKalender'])
      ->name('penjadwalan.edit');

    Route::post('/save', [ScheduleController::class, 'store'])
      ->name('penjadwalan.store');

    Route::put('/save/{id}', [ScheduleController::class, 'update'])
      ->name('penjadwalan.update');

    Route::delete('/delete/{id}', [ScheduleController::class, 'destroy'])
      ->name('penjadwalan.destroy');
  });

/*
|--------------------------------------------------------------------------
| Kegiatan Masjid
|--------------------------------------------------------------------------
*/
Route::prefix('kegiatan')->group(function () {

  Route::get('/', [ScheduleController::class, 'kegiatanPage'])
    ->name('kegiatan');

  Route::get('/{id}', [ScheduleController::class, 'show'])
    ->name('lihatkegiatan');
});

Route::middleware('auth')->prefix('kegiatan')
->group(function(){
  
  Route::get('/{id}/edit', [ScheduleController::class, 'formKegiatan'])
    ->name('editkegiatan');

  Route::put('/{id}', [ScheduleController::class, 'update'])
    ->name('updatekegiatan');
    
  Route::post('/kegiatan/{id}/items', [ScheduleItemController::class, 'store'])
    ->name('kegiatan.items.store');
  
  Route::delete('/kegiatan/items/{id}', [ScheduleItemController::class, 'destroy'])
    ->name('kegiatan.items.destroy');
});


/*
|--------------------------------------------------------------------------
| Donasi
|--------------------------------------------------------------------------
*/
Route::get('/donasi', fn() => view('donasiPage'))->name('donasi');

/*
|--------------------------------------------------------------------------
| Organisasi Masjid
|--------------------------------------------------------------------------
*/
Route::prefix('organisasi')->group(function () {

  Route::get('/', fn() => view('organisasi_masjid/organisasiPage'))
    ->name('organisasi');

  Route::get('/remajamasjid', fn() => view('organisasi_masjid/remajaMasjidPage'))
    ->name('remajamasjid');

  Route::get('/pengajianannisa', fn() => view('organisasi_masjid/pengajianannisaPage'))
    ->name('pengajianannisa');

  Route::get('/pengajianbapak', fn() => view('organisasi_masjid/pengajianbapakPage'))
    ->name('pengajianbapak');
});

/*
|--------------------------------------------------------------------------
| Galeri Masjid
|--------------------------------------------------------------------------
*/

Route::prefix('galeri')->group(function () {

  Route::get('/', [GalleryController::class, 'index'])
    ->name('galeri');

  Route::get('/{section}', [GalleryController::class, 'show'])
    ->whereIn('section', ['idaroh', 'imarah', 'riayah'])
    ->name('galeri.section');
});

Route::middleware('auth')->prefix('galeri')->group(function () {

  Route::post('/upload', [GalleryController::class, 'store'])
    ->name('galeri.upload');
});


/*
|--------------------------------------------------------------------------
| Dokumen Masjid
|--------------------------------------------------------------------------
*/
Route::prefix('dokumen')->group(function () {

  Route::get('/', fn() => view('dokumen_masjid.dokumenPage'))->name('dokumen');

  Route::get('/adart',fn() =>view('dokumen_masjid.adartPage'))->name('adartlaporan');

  Route::prefix('laporankeuangan')->group(function () {

    Route::get('/', [FinancialReportController::class, 'index'])
      ->name('laporankeuangan');

    Route::middleware('auth')->group(function () {

      Route::get('/unggah',fn() =>view('dokumen_masjid.laporan_keuangan.unggahPage'))->name('unggahlaporankeuangan');

      Route::post('/unggah', [FinancialReportController::class, 'store'])
        ->name('storelaporankeuangan');

      Route::delete('/hapus/{id}', [FinancialReportController::class, 'destroy'])
        ->name('hapuslaporankeuangan');
    });

    // TARUH PALING BAWAH
    Route::get('/{id}', [FinancialReportController::class, 'show'])
      ->name('lihatlaporankeuangan');
  });
});
