<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

// Import Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\FungsionarisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\TteController;
use App\Http\Controllers\AdminLibraryController;
use App\Http\Controllers\PublicLibraryController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\AdminInventoryController;
use App\Http\Controllers\AdminFinanceController;
use App\Http\Controllers\BukuBiruController;
use App\Http\Controllers\ShortLinkController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Guest & User)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth (Logout)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Halaman Profil & Informasi
Route::get('/video-profile', [VideoController::class, 'index'])->name('profile.video');
Route::get('/divisi', [FungsionarisController::class, 'index'])->name('fungsionaris');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');

// Layanan Static (Optimized)
Route::view('/katalog', 'pages.koprasikatalog')->name('katalog');

// Blog Public
Route::prefix('blog')->name('blog.')->group(function() {
    Route::get('/', function () {
        $posts = Post::with('author')->where('is_published', true)->latest()->get();
        return view('pages.blog.index', ['posts' => $posts, 'activePage' => 'blog']);
    })->name('index');

    Route::get('/{slug}', function ($slug) {
        $post = Post::with('author')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('pages.blog.show', ['post' => $post, 'activePage' => 'blog']);
    })->name('show');
});

// Layanan Public Library
Route::prefix('perpustakaan')->name('library.')->group(function() {
    Route::get('/', [PublicLibraryController::class, 'index'])->name('index');
    Route::get('/{id}', [PublicLibraryController::class, 'show'])->name('show');
});

// Aspirasi Public
Route::get('/aspirasi', [AspirationController::class, 'index'])->name('aspirasi.index');
Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspirasi.store');

// TTE Public
Route::prefix('tte')->name('tte.')->group(function() {
    Route::get('/ajukan', [TteController::class, 'create'])->name('create');
    Route::post('/ajukan', [TteController::class, 'store'])->name('store');
    Route::get('/lacak', [TteController::class, 'trackPage'])->name('track');
    Route::post('/lacak', [TteController::class, 'trackSearch'])->name('search');
    Route::get('/verify/{token}', [TteController::class, 'verify'])->name('verify');
    Route::get('/verify/{token}/download-qr', [TteController::class, 'downloadQr'])->name('download_qr');
});


/*
|--------------------------------------------------------------------------
| USER ROUTES (Protected)
|--------------------------------------------------------------------------
| Menu khusus untuk User/Anggota yang sudah login
*/

// PERBAIKAN: Menambahkan pengecekan role agar 'eksternal' tidak bisa masuk ke sini
Route::middleware(['auth', 'role:mahasiswa,admin,sekretaris,bendahara'])->group(function () {
    Route::prefix('buku-biru')->name('bukubiru.')->group(function() {
        Route::get('/', [BukuBiruController::class, 'index'])->name('index');
        Route::get('/input', [BukuBiruController::class, 'create'])->name('create');
        Route::post('/', [BukuBiruController::class, 'store'])->name('store');
        Route::get('/pdf', [BukuBiruController::class, 'exportPdf'])->name('pdf');
    });
    
    // Fitur Request TTE Buku Biru (Mahasiswa)
    Route::post('/buku-biru/{id}/request-tte', [BukuBiruController::class, 'requestTTE'])->name('buku-biru.request-tte');
});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES
|--------------------------------------------------------------------------
| Struktur: /admin/...
| Middleware Utama: Auth & Role Check
*/

// Middleware Utama sekarang mengizinkan role 'eksternal' untuk masuk ke dashboard admin
Route::middleware(['auth', 'role:admin,sekretaris,bendahara,eksternal'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. DASHBOARD (Semua Role Staff + Eksternal Bisa Akses)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---------------------------------------------------------------------
    // KHUSUS VIEW BUKU BIRU (Admin, Sekretaris, dan Eksternal)
    // ---------------------------------------------------------------------
    Route::middleware(['role:admin,sekretaris,eksternal'])->group(function() {
        Route::get('/bukubiru', [BukuBiruController::class, 'adminIndex'])->name('bukubiru.index');
    });

    // ---------------------------------------------------------------------
    // GROUP A: KHUSUS ADMIN (SUPER USER)
    // ---------------------------------------------------------------------
    Route::middleware(['role:admin'])->group(function() {
        
        // Manajemen User
        Route::controller(DashboardController::class)->prefix('users')->name('users.')->group(function() {
            Route::get('/', 'users')->name('index');
            Route::post('/{id}/approve', 'approveUser')->name('approve');
            Route::delete('/{id}/reject', 'rejectUser')->name('reject');
            Route::put('/{id}/role', 'updateUserRole')->name('updateRole');
            Route::delete('/{id}/destroy', 'destroyUser')->name('destroy');
        });

        // Manajemen Inventaris
        Route::controller(AdminInventoryController::class)->prefix('inventory')->name('inventory.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    // ---------------------------------------------------------------------
    // GROUP B: ADMIN & SEKRETARIS (Administrasi, Surat, Berita, & Aksi)
    // ---------------------------------------------------------------------
    Route::middleware(['role:admin,sekretaris'])->group(function() {
        
        // Blog Management
        Route::controller(AdminPostController::class)->prefix('blog')->name('blog.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // TTE Management (Gabungan Surat Umum & Buku Biru)
        Route::controller(TteController::class)->prefix('tte')->name('tte.')->group(function() {
            Route::get('/', 'adminIndex')->name('index');
            
            // Aksi Dokumen Umum
            Route::post('/{id}/approve', 'approve')->name('approve');
            Route::post('/{id}/reject', 'reject')->name('reject');
            Route::delete('/{id}', 'destroy')->name('destroy');

            // Aksi Buku Biru
            Route::post('/bukubiru/{id}/approve', 'approveBukuBiru')->name('approveBukuBiru');
            Route::post('/bukubiru/{id}/reject', 'rejectBukuBiru')->name('rejectBukuBiru');
        });

        // Lanjutan Buku Biru (Hanya rute AKSI yang ditaruh di sini)
        Route::controller(BukuBiruController::class)->prefix('bukubiru')->name('bukubiru.')->group(function() {
            // Rute get ('/') sudah ditaruh di atas agar eksternal bisa melihat
            
            // Validasi Dokumen Satuan
            Route::post('/{id}/approve', 'approve')->name('approve');
            Route::post('/{id}/reject', 'reject')->name('reject');
            Route::post('/{id}/reset', 'resetStatus')->name('reset');
            
            // Validasi TTE Buku Biru Keseluruhan
            Route::post('/{id}/approve-tte', 'approveTTE')->name('approve-tte');
            Route::post('/{id}/reject-tte', 'rejectTTE')->name('reject-tte');
        });

        // Library Management
        Route::controller(AdminLibraryController::class)->prefix('library')->name('library.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Aspirasi Management
        Route::controller(AspirationController::class)->prefix('aspirasi')->name('aspirasi.')->group(function() {
            Route::get('/', 'adminIndex')->name('index');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/read', 'markAsRead')->name('read');
        });

        // Route Manajemen Link (Shortlink)
        Route::controller(ShortLinkController::class)->prefix('links')->name('links.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    // ---------------------------------------------------------------------
    // GROUP C: ADMIN & BENDAHARA (Keuangan)
    // ---------------------------------------------------------------------
    Route::middleware(['role:admin,bendahara'])->group(function() {
        
        // Finance Management
        Route::controller(AdminFinanceController::class)->prefix('finance')->name('finance.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/export', 'export')->name('export');
        });
    });

});

/*
|--------------------------------------------------------------------------
| CUSTOM DOMAIN REDIRECT (WAJIB PALING BAWAH)
|--------------------------------------------------------------------------
| Menangkap semua URL 'himafiunud.com/{apa_saja}' yang tidak terdaftar di atas.
*/
Route::get('/{slug}', [ShortLinkController::class, 'handleRedirect'])->where('slug', '[A-Za-z0-9\-_]+');