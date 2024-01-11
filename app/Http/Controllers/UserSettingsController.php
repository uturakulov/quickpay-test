<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Services\SendConfirmationCodeService;
use Illuminate\Validation\ValidationException;

class UserSettingsController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function requestChange(Request $request, SendConfirmationCodeService $sendConfirmationCodeService): void
    {
        $this->validate($request, [
            'user_id' => 'required',
            'type' => 'required',
            Rule::in(['sms', 'email', 'telegram']),
        ]);

        $user = auth()->user();
        $sendConfirmationCodeService->sendCode($request->input('type'), $user->id);
    }

    public function verifyCode(Request $request): void
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'code' => 'required',
            'user_id' => 'required',
        ]);

        $user_id = (int) $request->input('user_id');
        $code = $request->input('code');
        $name = $request->input('name');
        $email = $request->input('email');

        if (Cache::get('user_' . $user_id) === $code) {
            DB::update('UPDATE users SET name = ?, email = ? WHERE id = ?', [$name, $email, $user_id]);
        }
    }
}
