<?php

namespace TidioLiveChat\Sdk\Encryption;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use TidioLiveChat\Sdk\Encryption\Exception\DecryptionFailedException;

interface EncryptionService
{
    /**
     * @param string $value
     * @return string
     */
    public function encrypt($value);

    /**
     * @param string $encryptedString
     * @return string
     * @throws DecryptionFailedException
     */
    public function decrypt($encryptedString);
}
