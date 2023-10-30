<?php

namespace App\Actions;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\VerificationCodeService;
use Exception;

final class UserSetPaymentMethodAction
{

    protected VerificationCodeService $verificationCodeService;
    public function __construct(
        protected User $user,
        protected PaymentMethod $paymentMethod,
        protected string $code
    )
    {
        $verificationCodeService = new VerificationCodeService($this->user);
    }


    public function handle():void
    {
       if($this->verificationCodeService->checkCode($this->code)){
           $this->user->paymentMethod()->associate($this->paymentMethod);
       }
       throw new Exception('Настройка не сохранилась');
    }


}
