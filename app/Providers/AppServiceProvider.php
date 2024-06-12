<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('currency', function ($amount) {
            return "<?php echo 'Rp. ' . number_format($amount, 0, ',', '.'); ?>";
        });

        Blade::directive('date_indo_formatted', function ($date) {
            Carbon::setLocale('id');
            return "<?php echo Carbon\Carbon::parse($date)->translatedFormat('l, d F Y'); ?>";
        });

        Blade::directive('currency_to_text', function ($amount) {
            return "<?php echo app('App\\Helpers\\TranslateMonth')->convertAmountToText($amount); ?>";
        });
    }
}
