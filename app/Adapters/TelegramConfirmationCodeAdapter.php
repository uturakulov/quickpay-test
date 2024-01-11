<?php

namespace App\Adapters;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\HttpServices\TelegramHttpService;
use App\Interfaces\ConfirmationAdapterInterface;

class TelegramConfirmationCodeAdapter implements ConfirmationAdapterInterface
{
    public function __construct(private TelegramHttpService $telegramService)
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
        $result = DB::select('SELECT telegram_nickname FROM users WHERE id = ?', [$userId]);

        $this->telegramService->sendCode($result[0]->telegram_nickname, $code);
    }
}
