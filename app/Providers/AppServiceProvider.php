<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        //Rupiah converter
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        //Rupiah converter tanparp
        Blade::directive('currencynorp', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
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

        // With locale
        Carbon::parse('2019-03-01')->translatedFormat('d F Y'); //Output: "01 Maret 2019"

    }
}
