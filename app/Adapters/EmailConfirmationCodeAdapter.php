<?php

namespace App\Adapters;

use App\Interfaces\ConfirmationAdapterInterface;
use Illuminate\Support\Facades\Cache;
use Ramsey\Uuid\Uuid;

class EmailConfirmationCodeAdapter implements ConfirmationAdapterInterface
{
    public function __construct(private EmailService $emailService)
    {
    }

    public function generateCode($userId): string
    {
        $code = Uuid::uuid4()->toString();
        $cache_key = 'user_' . $userId;
        Cache::put($cache_key, $code, 180);

        return $code;
    }

    public function sendCode($userId, $code)
    {
        return $this->emailService->sendCode($userId, $code);
    }
}