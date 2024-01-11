<?php

namespace App\Interfaces;

interface ConfirmationAdapterInterface
{
    public function sendCode(int $userId, string $code);

    public function generateCode($userId): string;
}
