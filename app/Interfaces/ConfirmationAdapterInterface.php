<?php

namespace App\Interfaces;

interface ConfirmationAdapterInterface
{
    public function sendCode($userId, $code);
    public function generateCode($userId): string;
}
