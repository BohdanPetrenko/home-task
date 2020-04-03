<?php

declare(strict_types=1);

namespace app\Services\PaymentCard;

use App\Events\CardAdded;
use App\Http\Controllers\PaymentCardController;
use App\PaymentCard;
use App\User;
use Illuminate\Events\Dispatcher;
use Illuminate\Hashing\HashManager;

use function array_merge;
use function array_rand;

class SaveManager
{
    private Dispatcher $eventDispatcher;

    private PaymentCard $card;

    private HashManager $hash;

    public function __construct(Dispatcher $eventDispatcher, PaymentCard $card, HashManager $hash)
    {
        $this->card = $card;
        $this->eventDispatcher = $eventDispatcher;
        $this->hash = $hash;
    }

    public function store(User $user, array $data, PaymentCardController $controller)
    {
        $this->hashValues($data);
        $this->addPaymentSystem($data);

        /** @var PaymentCard $card */
        $card = $user->paymentCard()->create($data);

        $this->eventDispatcher->dispatch(new CardAdded($card));
    }

    private function hashValues(array &$data): void
    {
        $data['cvv'] = $this->hash->make($data['cvv']);
        $data['expiration'] = $this->hash->make($data['expiration']);
    }

    public function addPaymentSystem(array &$data): void
    {
        if ($data['payment_system'] === 'null') {
            $randPaymentSystem['payment_system'] = PaymentCard::PAYMENT_SYSTEM[array_rand(PaymentCard::PAYMENT_SYSTEM)];
            $data = array_merge($data, $randPaymentSystem);
            ;
        }
    }
}
