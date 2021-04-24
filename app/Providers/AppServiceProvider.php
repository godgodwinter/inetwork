<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //Rupiah converter
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        //Tanggal Indo
        Blade::directive('tanggalindo', function ($expression) {

        //   return dd(Carbon::parse($expression)->translatedFormat('d F Y'));
        return Carbon::parse($expression)->translatedFormat('d F Y');
        });

        //local Carbon
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');


        // Without locale, the output gonna be like this
        // Carbon::parse('2019-03-01')->format('d F Y'); //Output: "01 March 2019"

        // With locale
        Carbon::parse('2019-03-01')->translatedFormat('d F Y'); //Output: "01 Maret 2019"

    }
}
