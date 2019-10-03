<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class RandomHelper
{
    const PERMITTER_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function randomString(int $length = 10) : string
    {
        $this->logger->info('User has asked an random string!');
        return $this->generateRandomString($length);
    }

    private function generateRandomString(int $length = 10) : string {
        $input_length = strlen(self::PERMITTER_CHARS);
        $random_string = '';
        for($i = 0; $i < $length; $i++) {
            $random_character = self::PERMITTER_CHARS[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

}