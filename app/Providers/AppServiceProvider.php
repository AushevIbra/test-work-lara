<?php

namespace App\Providers;

use App\Models\Order;
use App\Observers\OrderObserver;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $client = new Client([
            'http_errors' => false,
        ]);
        $response = $client->get("https://api.weather.yandex.ru/v1/forecast?lat=53.25209&lon=34.37167&extra=true", [
            'headers' => [
                'X-Yandex-API-Key' => '5fa56770-3339-469c-8dd1-63fcf0a04895',
            ],
        ]);
        $data = json_decode($response->getBody()->getContents());
        $temp = $data->fact->temp ?? 0;
        View::share('temperature', $temp);

        Order::observe(OrderObserver::class);
    }
}
