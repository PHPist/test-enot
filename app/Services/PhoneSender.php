<?php

namespace App\Services;

class PhoneSender implements Sender
{

    public function sendCode(string $code): bool
    {
        return true;
    }
}
