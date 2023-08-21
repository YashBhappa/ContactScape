<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();

        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;

            foreach ($bindings as $replace) {
                $value = is_numeric($replace) ? $replace : "'{$replace}'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }

            Log::info("SQL: {$sql} | Time: {$time}");
        });
    }
}
