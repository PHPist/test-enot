<?php

namespace App\Services;

use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VerificationCodeService
{

    public function __construct(
        protected  User $user,
    ){

    }

    public function checkCode(string $code):bool
    {
        return $this->getCode()->code === $code;
    }

    public function sendCode():VerificationCode
    {
        $sender = match ($this->user->confirmation_setting_change){
            'email'=> new  EmailSender(),
            'phone'=> new  PhoneSender(),
        };

        $code = $this->getCode();
        $sender->sendCode($code->code);

        return $code;
    }


    protected function getCode(): VerificationCode
    {
        return VerificationCode::query()->firstOrCreate([
            'user_id'=>$this->user->id,
        ],
        [
            'code'=>$this->generateCode()
        ]
        );
    }

    protected function generateCode():string
    {
        return rand(1000,5000);
    }

}
