
<div class="icheck-primary">
    <div class="custom-control custom-switch custom-default-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch1{{ $id }}" wire:click="toggleDefault({{ $id }})" name="default" {{ $default == 1 ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch1{{ $id }}">&nbsp;</label>
    </div>
</div>