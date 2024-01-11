<?php

namespace App\HttpServices;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class EmailHttpService
{
    public function sendCode(string $email, string $code): void
    {
        $this->baseRequest()
            ->post('/send', ['email' => $email, 'code' => $code])
            ->throw();
    }

    public function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.email.domain'))
            ->acceptJson()
            ->timeout(60);
    }
}
