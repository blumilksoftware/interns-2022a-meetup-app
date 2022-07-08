<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Services;

use Blumilk\Meetup\Core\Models\NewsletterSubscriber;
use Blumilk\Meetup\Core\Models\User;
use Blumilk\Meetup\Core\Models\User2FaCode;
use Blumilk\Meetup\Core\Notifications\TwoStepVerificationNotification;
use Blumilk\Meetup\Core\Services\Authentication\UserLoginService;
use Illuminate\Auth\AuthenticationException;
use function PHPUnit\Framework\isFalse;

class User2FaCodesService
{
    public function __construct(
        protected UserLoginService $loginService,
    ){}

    public function generateCode(User $user)
    {
        $code = rand(100000, 999999);

        User2FaCode::updateOrCreate(
            ['user_id' => $user->id],
            ['code' => $code]
        );
        $user->notify(new TwoStepVerificationNotification($user, $code));
    }

    public function checkCode(string $id, string $code){
        $userCode = User2FaCode::query()->where("user_id",$id)->first();
        if($code != $userCode->code){
            throw new AuthenticationException("Wrong code");
        }
    }
}
