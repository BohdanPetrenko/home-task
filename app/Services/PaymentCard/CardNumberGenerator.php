<?php

declare(strict_types=1);

namespace App\Services\PaymentCard;

use function floor;
use function rand;
use function strlen;
use function strrev;

class CardNumberGenerator
{
    public function getNumber($prefixList, $length = 16): int
    {
        $ccnumber = $prefixList;

        # generate digits

        while (strlen($ccnumber) < ($length - 1)) {
            $ccnumber .= rand(0, 9);
        }

        # Calculate sum

        $sum = 0;
        $pos = 0;

        $reversedCCnumber = strrev($ccnumber);

        while ($pos < $length - 1) {
            $odd = $reversedCCnumber[$pos] * 2;
            if ($odd > 9) {
                $odd -= 9;
            }

            $sum += $odd;

            if ($pos != ($length - 2)) {
                $sum += $reversedCCnumber[$pos + 1];
            }
            $pos += 2;
        }

        # Calculate check digit

        $checkdigit = ((floor($sum / 10) + 1) * 10 - $sum) % 10;
        $ccnumber .= $checkdigit;

        return (int) $ccnumber;
    }
}
