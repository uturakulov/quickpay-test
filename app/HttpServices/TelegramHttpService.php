<?php

namespace App\HttpServices;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class TelegramHttpService
{
    public function sendCode(string $telegram_nickname, string $code): void
    {
        $this->baseRequest()
            ->post('/send', ['telegram_nickname' => $telegram_nickname, 'code' => $code])
            ->throw();
    }

    public function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.telegram.domain'))
            ->acceptJson()
            ->timeout(60);
    }
}
