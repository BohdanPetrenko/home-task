<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Class PaymentCard
 *
 * @property int $id
 * @property int $user_id
 * @property string $payment_system
 * @property float $card_number
 * @property string $cvv
 * @property string $expiration
 * @property Carbon $created_at
 *
 * @property User $user
 * @property PaymentCardBalance $balance
 * @property Collection|TransactionLog $log
 */
class PaymentCard extends Model
{
    public const PAYMENT_SYSTEM = [
        'VISA',
        'MASTERCARD',
    ];
    public $timestamps = false;

    protected $with = ['balance'];

    protected $table = 'payment_cards';

    protected $fillable = [
        'payment_system',
        'card_number',
        'cvv',
        'expiration',
    ];
    protected $hidden = ['cvv', 'expiration'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function balance(): HasOne
    {
        return $this->hasOne(PaymentCardBalance::class);
    }

    public function getCardNumberAttribute($value): int
    {
        return (int)$value;
    }

    public function log(): HasMany
    {
        return $this->hasMany(TransactionLog::class, 'sender', 'card_number');
    }
}
