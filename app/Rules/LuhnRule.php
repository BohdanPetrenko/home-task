<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use function strlen;

class LuhnRule implements Rule
{
    private string $attribute = '';

    private string $value = '';

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;
        $this->value = $value;
        return $this->isLuhn();
    }

    public function message()
    {
        return __('messages.rules.luhn', [
            'attribute' => $this->attribute,
            'number' => $this->value
        ]);
    }

    private function isLuhn(): bool
    {
        $sum = 0;
        for ($i = 0, $j = strlen($this->value); $i < $j; $i++) {
            if (($i % 2) == 0) {
                $val = $this->value[$i];
            } else {
                $val = $this->value[$i] * 2;
                if ($val > 9) {
                    $val -= 9;
                }
            }
            $sum += $val;
        }

        return ($sum % 10) == 0;
    }
}
