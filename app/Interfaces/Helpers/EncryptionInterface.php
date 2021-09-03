<?php

namespace App\Interfaces\Helpers;

interface EncryptionInterface
{
    /**
     * @param $string
     * @return string
     */
    public function encryptString($string);

    /**
     * @param $check
     * @param $checkAgainst
     * @return bool
     */
    public function checkEncryption($check, $checkAgainst);

    public function generateStrongPassword();
}
