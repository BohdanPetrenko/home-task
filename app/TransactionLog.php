<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TransactionLogger
 *
 * @property int $id
 * @property double $sender
 * @property double $recipient
 * @property double $transfer_amount
 * @property bool $status
 * @property Carbon $transaction_at
 *
 * @property PaymentCard $paymentCard
 */
class TransactionLog extends Model
{
    public $timestamps = false;

    protected $table = 'transaction_logs';

    protected $fillable = [
        'sender',
        'recipient',
        'transfer_amount',
        'transaction_at',
        'status',
    ];

    public function getSenderAttribute($value): int
    {
        return (int)$value;
    }

    public function getRecipientAttribute($value): int
    {
        return (int)$value;
    }

    public function paymentCard(): BelongsTo
    {
        return $this->belongsTo(PaymentCard::class, 'card_number', 'sender');
    }
}
