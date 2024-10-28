<form wire:submit.prevent="submit" id="{{ $action }}-form" class="form">
    <div class="row gy-5">
        <x-dashboard.fields.input type="text" wire:model="name" wire:key="{{ $action }}-name" id="{{ $action }}-name" name="name" cols="col-lg-6 col-12" label="{{ __('Name') }}" placeholder="{{ __('Name') }}" required />

        <div class="col-lg-6 col-12">
            <label for="create-project-name" class="form-label fs-6 fw-bolder text-gray-700 required">Type of profile</label>
            <div class="row mt-3">
                @foreach ($profileTypes as $typeValue => $typeName)
                    <x-dashboard.fields.radio wire:model="type" wire:key="{{ $action }}-type-{{ $typeValue }}" id="{{ $action }}-type-{{ $typeValue }}" name="type" value="{{ $typeValue }}" cols="col-auto align-self-end" label="{{ $typeName }}" placeholder="{{ $typeName }}" />
                @endforeach
            </div>
        </div>

        <x-dashboard.fields.select wire:model="profile" wire:key="{{ $action }}-profile" id="{{ $action }}-profile" :options="$profiles" name="profile" cols="col-md-6 col-12" label="{{ __('Profile') }}" data-placeholder="{{ __('Profile') }}" required data-dropdown-parent="#{{ $action }}-modal-content" required />

        <x-dashboard.fields.input type="number" step="0.01" wire:model="width_top_inside" wire:key="{{ $action }}-width_top_inside" id="{{ $action }}-width_top_inside" name="width_top_inside" cols="col-lg-6 col-12" label="{{ __('Width Top Inside') }}" placeholder="{{ __('Width Top Inside') }}" required />

        <x-dashboard.fields.input type="number" step="0.01" wire:model="width_down_inside" wire:key="{{ $action }}-width_down_inside" id="{{ $action }}-width_down_inside" name="width_down_inside" cols="col-lg-6 col-12" label="{{ __('Width Down Inside') }}" placeholder="{{ __('Width Down Inside') }}" required />

        <x-dashboard.fields.input type="number" step="0.01" wire:model="height_inside" wire:key="{{ $action }}-height_inside" id="{{ $action }}-height_inside" name="height_inside" cols="col-lg-6 col-12" label="{{ __('Height Inside') }}" placeholder="{{ __('Height Inside') }}" required />

        <x-dashboard.fields.input type="number" step="0.01" wire:model="height_outside" wire:key="{{ $action }}-height_outside" id="{{ $action }}-height_outside" name="height_outside" cols="col-lg-6 col-12" label="{{ __('Height Outside') }}" placeholder="{{ __('Height Outside') }}" required />

        <x-dashboard.fields.textarea wire:model="note" wire:key="{{ $action }}-note" id="{{ $action }}-note" name="note" cols="col-md-12 col-12" label="{{ __('Note') }}" placeholder="{{ __('Note') }}" />
    </div>

    <div class="text-end mt-5">
        <x-dashboard.fields.button type="button" class="btn-light me-3" data-bs-dismiss="modal">{{ __('Cancel') }}</x-dashboard.fields.button>
        <x-dashboard.fields.button type="submit" class="btn-primary">{{ __('Submit') }}</x-dashboard.fields.button>
    </div>
</form>
