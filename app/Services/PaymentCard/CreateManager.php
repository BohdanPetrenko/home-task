<?php

declare(strict_types=1);

namespace App\Services\PaymentCard;

use App\Http\Controllers\PaymentCardController;

class CreateManager
{
    private CardNumberGenerator $ccGenerator;

    private CvvGenerator $cvvGenerator;

    public function __construct(CardNumberGenerator $ccGenerator, CvvGenerator $cvvGenerator)
    {
        $this->ccGenerator = $ccGenerator;
        $this->cvvGenerator = $cvvGenerator;
    }

    public function getDefaultValues(PaymentCardController $controller): array
    {
        return [
            'cardNumber' => $this->ccGenerator->getNumber('4929', 16),
            'cvv' => $this->cvvGenerator->getCvv(),
            'expiration' => now()->addYears(4)->format('m/y'),
        ];
    }
}
