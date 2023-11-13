<?php

namespace App\Providers;

use App\Contracts\NotifyServiceContract;
use App\Services\EmailService;
use App\Services\SmsService;
use App\Services\TelegramService;
use Illuminate\Support\ServiceProvider;
use Mockery\Exception;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotifyServiceContract::class, function ($app, array $params) {
            if (!isset($params['name'])) {
                throw new Exception('Необходимо указать названия сервиса для уведомлений!');
            }
            return match ($params['name']) {
                'telegram' => new TelegramService(),
                'sms' => new SmsService(),
                'email' => new EmailService(),
                default => throw new Exception('Необходимо указать названия сервиса для уведомлений из существующих!'),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
