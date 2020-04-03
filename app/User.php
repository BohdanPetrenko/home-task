<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $avatar
 * @property string $rememberToken
 * @property Carbon $created_at
 * @property Carbon $updated_at
 **
 * @property Collection|PaymentCard[] $paymentCard
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasCard(int $cardNumber): bool
    {
        return $this->paymentCard()->where('card_number', $cardNumber)->exists();
    }

    public function paymentCard(): HasMany
    {
        return $this->hasMany(PaymentCard::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
