<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Models\UserTwoFaCode;
use Blumilk\Meetup\Core\Notifications\TwoStepVerificationNotification;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Illuminate\Auth\AuthenticationException;

class UserTwoFaService
{
    public function __construct(
        protected UserLoginService $loginService,
    ) {}

    public function generateCode(string $email): void
    {
        $user = User::query()->where("email", $email)->first();
        $code = rand(100000, 999999);

        $user->code()->updateOrCreate(
            ["user_id" => $user->id],
            ["code" => $code],
        );

        $user->notify(new TwoStepVerificationNotification($user, $code));
    }

    /**
     * @throws AuthenticationException
     */
    public function checkCode(string $id, int $code): void
    {
        $userCode = UserTwoFaCode::query()->where("user_id", $id)->first();

        if ($code !== (int)$userCode->code) {
            throw new AuthenticationException("Wrong code");
        }
    }
}
