<form wire:submit.prevent="submit" id="{{ $action }}-form" class="form">
    <div class="row gy-5">
        <x-dashboard.fields.file wire:ignore wire:model="image" wire:key="{{ $action }}-image" id="{{ $action }}-image" name="file" data-input-name="image" accept="image/*" error="image" :urls="isset($image) ? [$image] : []" cols="col-md-12 col-12" label="{{ __('Image') }}" placeholder="{{ __('Image') }}" />

        <x-dashboard.fields.input type="text" wire:model="name" wire:key="{{ $action }}-name" id="{{ $action }}-name" error="name" cols="col-md-6 col-12" label="{{ __('Name') }}" placeholder="{{ __('Name') }}" required />

        <x-dashboard.fields.input type="text" wire:model="email" wire:key="{{ $action }}-email" id="{{ $action }}-email" error="email" cols="col-md-6 col-12" label="{{ __('Email') }}" placeholder="{{ __('Email') }}" required />

        <div class="separator separator-dashed separator-content border-primary mb-6 mt-10">
            {{ __('Password') }}
        </div>

        <x-dashboard.fields.password wire:model="password" wire:key="{{ $action }}-password" id="{{ $action }}-password" error="password" cols="col-md-6 col-12" label="{{ __('Password') }}" placeholder="{{ __('Password') }}" autocomplete="off" />

        <x-dashboard.fields.input type="password" wire:model="password_confirmation" wire:key="{{ $action }}-password_confirmation" id="{{ $action }}-password_confirmation" error="password_confirmation" cols="col-md-6 col-12" label="{{ __('Confirm Password') }}" placeholder="{{ __('Confirm Password') }}" autocomplete="off" />

    </div>

    <div class="text-end mt-5">
        <x-dashboard.fields.button type="button" class="btn-light me-3" data-bs-dismiss="modal">{{ __('Cancel') }}</x-dashboard.fields.button>
        <x-dashboard.fields.button type="submit" class="btn-primary">{{ __('Submit') }}</x-dashboard.fields.button>
    </div>
</form>
