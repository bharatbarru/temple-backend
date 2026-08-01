
<div class="icheck-primary">
    <div class="custom-control custom-switch custom-publish-switch">
        <input type="checkbox" class="custom-control-input" id="customSwitch{{ $id }}" wire:click="togglePublish({{ $id }})" name="publish" {{ $publish == 1 ? 'checked' : '' }}>
        <label class="custom-control-label" for="customSwitch{{ $id }}">&nbsp;</label>
    </div>
</div>