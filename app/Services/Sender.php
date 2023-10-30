<?php

namespace App\Services;

interface Sender
{
    public function sendCode(string $code):bool;
}
