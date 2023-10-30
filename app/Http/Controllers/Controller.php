<?php

namespace App\Http\Controllers;

use App\Actions\UserSetPaymentMethodAction;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\VerificationCodeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function getCode(): JsonResponse
    {
        $verificationCodeService = new VerificationCodeService(Auth::user());
        return new JsonResponse([$verificationCodeService->sendCode()]);
    }


    public function userSetPaymentMethod(PaymentMethod $paymentMethod, Request$request): JsonResponse
    {
        $verificationCodeService = new VerificationCodeService(Auth::user());
        $request->validate([
            'code'=>[
                'required',
                'string',
                'min:4',
                'max:4',
                function($attribute, $value, $fail) use ($verificationCodeService) {
                    if(!$verificationCodeService->checkCode()){
                        $fail('Введенный '.$attribute.' неверный');
                    }
                }
            ]
        ]);
        (new UserSetPaymentMethodAction(Auth::user(), $paymentMethod, $request->get('code')))->handle();
        return new JsonResponse();
    }
}
