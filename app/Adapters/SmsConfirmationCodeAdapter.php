<?php

namespace App\Adapters;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\HttpServices\SmsHttpService;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\ConfirmationAdapterInterface;

class SmsConfirmationCodeAdapter implements ConfirmationAdapterInterface
{
    public function __construct(private SmsHttpService $smsService)
    {
    }

    public function generateCode($userId): string
    {
        $code = Uuid::uuid4()->toString();
        $cache_key = 'user_' . $userId;
        Cache::put($cache_key, $code, 180);

        return $code;
    }

    public function sendCode(int $userId, string $code): void
    {
        $result = DB::select('SELECT phone FROM users WHERE id = ?', [$userId]);

        $this->smsService->sendCode($result[0]->phone, $code);
    }
}
