<form wire:submit.prevent="updatePassword">
    <div class="row g-2">
        <x-dashboard.fields.input type="password" id="current_password" wire:model.defer="current_password" autocomplete="current-password" cols="col-lg-6 col-12" label="{{ __('Current Password') }}" placeholder="{{ __('Current Password') }}" />
    </div>

    <div class="row mt-2 g-2">
        <x-dashboard.fields.input type="password" id="password" wire:model.defer="password" autocomplete="new-password" cols="col-lg-6 col-12" label="{{ __('New Password') }}" placeholder="{{ __('New Password') }}" />

        <x-dashboard.fields.input type="password" id="password_confirmation" wire:model.defer="password_confirmation" autocomplete="new-password" cols="col-lg-6 col-12" label="{{ __('Confirm Password') }}" placeholder="{{ __('Confirm Password') }}" />
    </div>

    <div class="text-end mt-3">
        <x-dashboard.fields.button type="submit" class="btn-primary">{{ __('Submit') }}</x-dashboard.fields.button>
    </div>
</form>
