<?php

declare(strict_types=1);

namespace App\Services\PaymentCard;

class CvvGenerator
{
    public function getCvv(): int
    {
        $value = mt_rand(1, 9);

        for ($i = 0; $i < 2; $i++) {
            $value .= mt_rand(0, 9);
        }

        return (int) $value;
    }
}
