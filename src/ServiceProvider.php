<?php
namespace CodeSmithTech\Linford;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'linford');
        $this->publishes([
            __DIR__ . '/../ui/dist' => public_path('vendor/linford'),
        ], 'linford');
    }
}