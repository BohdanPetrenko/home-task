<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionLogger
 *
 * @property int $id
 * @property double $sender
 * @property double $recipient
 * @property double $transfer_amount
 * @property bool $status
 * @property Carbon $transaction_at
 */
class TransactionLog extends Model
{
    protected $table = 'transaction_logs';

    public $timestamps = false;

    protected $fillable = [
        'sender',
        'recipient',
        'transfer_amount',
        'transaction_at',
        'status',
    ];

    public function getSenderAttribute($value): int
    {
        return (int) $value;
    }

    public function getRecipientAttribute($value): int
    {
        return (int) $value;
    }
}
