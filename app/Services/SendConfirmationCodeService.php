<?php

namespace App\Services;

class SendConfirmationCodeService
{
    public function __construct(
        private BindVerificationAdapterService $bindVerificationAdapterService
    )
    {
    }

    public function sendCode(string $type, int $user_id): void
    {
        $service = $this->bindVerificationAdapterService->bind($type);

        $code = $service->generateCode($user_id);
        $service->sendCode($user_id, $code);
    }
}
