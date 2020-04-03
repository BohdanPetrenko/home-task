<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class PaymentCardBalance
 *
 * @property int $id
 * @property int $payment_card_id
 * @property double $balance
 * @property Carbon $updated_at
 *
 * @property PaymentCard $card
 */
class PaymentCardBalance extends Model
{
    protected $with = ['card'];

    protected $table = 'payment_card_balance';

    protected $fillable = ['balance'];

    public $timestamps = false;

    public function card(): BelongsTo
    {
        return $this->belongsTo(PaymentCard::class);
    }
}
