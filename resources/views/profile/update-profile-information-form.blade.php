<form wire:submit.prevent="updateProfileInformation">
    <div class="row g-2">
        <x-dashboard.fields.input type="text" wire:model.defer="name" id="user-profile-name" name="name" cols="col-lg-6 col-12" label="{{ __('Name') }}" placeholder="{{ __('Name') }}" required />

        <x-dashboard.fields.input-group type="text" wire:model.defer="email" id="user-profile-email" name="email" cols="col-lg-6 col-12" addon-content="<i class='fa fa-at'></i>" label="{{ __('Email') }}" placeholder="{{ __('Email') }}" />
    </div>

    <div class="text-end mt-3">
        <x-dashboard.fields.button type="submit" wire:loading.attr="disabled" wire:target="photo" class="btn-primary">{{ __('Submit') }}</x-dashboard.fields.button>
    </div>
</form>
