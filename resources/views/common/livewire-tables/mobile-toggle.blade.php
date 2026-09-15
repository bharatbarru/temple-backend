
<div class="icheck-primary">
    <div class="custom-control custom-switch custom-publish-switch">
        <input type="checkbox" class="custom-control-input" id="mobileSwitch{{ $id }}" wire:click="toggleMobileToggle({{ $id }})" name="mobile_toggle" {{ $mobile_toggle == 1 ? 'checked' : '' }}>
        <label class="custom-control-label" for="mobileSwitch{{ $id }}">&nbsp;</label>
    </div>
</div>
