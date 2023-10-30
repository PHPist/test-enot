<?php

namespace App\Services;

class EmailSender implements Sender
{

    public function sendCode(string $code): bool
    {
        return true;
    }
}
