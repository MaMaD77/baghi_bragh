<x-app-layout :breadcrumbs="$breadcrumbs">

    <x-slot name="title">{{ $title = __('Users') }}</x-slot>

    <x-dashboard.sections.card class="px-0">
        <x-slot name="title">
            <x-dashboard.sections.datatable-search model="user" />
        </x-slot>

        <x-slot name="toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <x-dashboard.sections.datatable-filter-button model="user" />
                {{-- <x-dashboard.sections.datatable-export model="user">
                    <x-dashboard.fields.select-ajax-multiple id="countries" name="countries[]" error="countries" :values="old('countries')" :url="route('api.countries')" multiple data-close-on-select="false" cols="col-12" label="Country" data-placeholder="Country" />
                </x-dashboard.sections.datatable-export> --}}
                <x-dashboard.fields.button type="button" class="btn-primary create-user-button">
                    <x-dashboard.sections.plus-icon />
                    {{ __('Add User') }}
                </x-dashboard.fields.button>
            </div>

            <x-dashboard.sections.datatable-action model="user" />
        </x-slot>
        <x-dashboard.sections.datatable-filter model="user" />

        <x-dashboard.models.user.tables.all />
    </x-dashboard.sections.card>

    @push('modals')
        <livewire:dashboard.models.user.create-modal />
        <livewire:dashboard.models.user.edit-modal />
    @endpush
</x-app-layout>
