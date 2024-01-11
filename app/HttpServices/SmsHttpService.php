<?php

namespace App\HttpServices;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class SmsHttpService
{
    public function sendCode(string $phone, string $code): void
    {
        $this->baseRequest()
            ->post('/send', ['phone' => $phone, 'code' => $code])
            ->throw();
    }

    public function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.sms.domain'))
            ->acceptJson()
            ->timeout(60);
    }
}
