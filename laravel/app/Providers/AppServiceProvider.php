<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        if (config('app.env') !== 'production') {
            // ログに SQL を出力する
            DB::listen(function ($query) {
                Log::info('SQL', [
                    'Time' => $query->time . 'ms',
                    'SQL' => $query->sql,
                ]);
            });
        }
    }
}
