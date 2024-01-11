<?php

namespace App\Services;

use Exception;
use App\Adapters\SmsConfirmationCodeAdapter;
use App\Adapters\EmailConfirmationCodeAdapter;
use App\Interfaces\ConfirmationAdapterInterface;
use Illuminate\Contracts\Foundation\Application;
use App\Adapters\TelegramConfirmationCodeAdapter;

class BindVerificationAdapterService
{
    public function __construct(
        private Application $app,
    ) {
    }

    /**
     * @throws Exception
     */
    public function bind(string $type): ConfirmationAdapterInterface
    {
        match ($type) {
            'sms' => $this->app->bind(ConfirmationAdapterInterface::class, SmsConfirmationCodeAdapter::class),
            'email' => $this->app->bind(ConfirmationAdapterInterface::class, EmailConfirmationCodeAdapter::class),
            'telegram' => $this->app->bind(ConfirmationAdapterInterface::class, TelegramConfirmationCodeAdapter::class),
            default => throw new Exception('Метод не найден'),
        };

        return $this->app->make(ConfirmationAdapterInterface::class);
    }
}
