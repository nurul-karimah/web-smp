<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\Models\Pembayaran;
use App\Models\Siswa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     // Register blade component untuk orangtua
    //     Blade::component('layouts.orangtua', 'orangtua-layout');

    //     // View composer untuk orangtua
    //     View::composer('layouts.navigationOrangtua', function ($view) {
    //         $jumlahTagihanBelumLunas = 0;

    //         if (Auth::guard('orangtua')->check()) {
    //             $orangtua = Auth::guard('orangtua')->user();
    //             $siswa = Siswa::where('orangtua_id', $orangtua->id)->first();

    //             if ($siswa) {
    //                 $jumlahTagihanBelumLunas = Pembayaran::where('siswa_id', $siswa->id)
    //                     ->where('status_pembayaran', 'belum lunas')
    //                     ->count();
    //             }
    //         }

    //         $view->with('jumlahTagihanBelumLunas', $jumlahTagihanBelumLunas);
    //     });

    //     // View composer untuk admin/web
    //     View::composer('layouts.navigation', function ($view) {
    //         $jumlahTagihanBelumLunas = 0;

    //         if (Auth::guard('web')->check()) {
    //             $jumlahTagihanBelumLunas = Pembayaran::where('status_pembayaran', 'belum lunas')->count();
    //         }

    //         $view->with('jumlahTagihanBelumLunas', $jumlahTagihanBelumLunas);

    //     });
    // }
}
