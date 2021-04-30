<?php

namespace App\Providers;

use App\Contracts\Translator;
use App\Http\Controllers\RussianTranslatorController;
use App\Services\RussianTranslatorService;
use Illuminate\Support\ServiceProvider;

class GoogleTranslatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(RussianTranslatorController::class)
                  ->needs(Translator::class)
                  ->give(RussianTranslatorService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
