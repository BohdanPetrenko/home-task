<div class="col-md-3">
    <label for="sender">Expiration date</label>
    <input type="text" class="form-control" name="expiration"
           value="{{ old('expiration') ?? $value ?? '' }}"
           required
           pattern="^([0]\d|(1[0-2]))\/(2[1-9]|[3-9]\d)$"
           placeholder="03/24">
</div>