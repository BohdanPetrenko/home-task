<label for="sender">{{ $label ?? 'Card number' }}</label>
<input type="text" class="form-control" name="{{ $name ?? 'card_number'}}"
       value="{{ old(($name ?? 'card_number')) ?? $value ?? '' }}"
       required
       pattern="[0-9]{16}"
       placeholder="{{ $placeholder ?? 'card number' }}">