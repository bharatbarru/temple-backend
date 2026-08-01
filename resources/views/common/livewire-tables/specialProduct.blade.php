
<div class="icheck-primary">
    <div class="custom-control custom-switch custom-special_product-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch{{ $id }}" wire:click="toggleSpecialProduct({{ $id }})" name="special_product" {{ $special_product == 1 ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch{{ $id }}">&nbsp;</label>
    </div>
</div>