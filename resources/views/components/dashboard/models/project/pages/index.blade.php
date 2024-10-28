<x-app-layout :breadcrumbs="$breadcrumbs">

    <x-slot name="title">{{ $title = __('Projects') }}</x-slot>

    <x-dashboard.sections.card class="px-0">
        <x-slot name="title">
            <x-dashboard.sections.datatable-search model="project" />
        </x-slot>

        <x-slot name="toolbar">
            <div class="d-flex justify-content-end" data-kt-project-table-toolbar="base">
                <x-dashboard.sections.datatable-filter-button model="project" />

                <x-dashboard.fields.button type="button" class="btn-primary create-project-button">
                    <x-dashboard.sections.plus-icon />
                    {{ __('Add Project') }}
                </x-dashboard.fields.button>
            </div>

            <x-dashboard.sections.datatable-action model="project">
            </x-dashboard.sections.datatable-action>


        </x-slot>

        <x-dashboard.sections.datatable-filter model="project">
        </x-dashboard.sections.datatable-filter>

        <x-dashboard.models.project.tables.all />
    </x-dashboard.sections.card>

    @push('modals')
        <livewire:dashboard.models.project.create-modal />
        <livewire:dashboard.models.project.edit-modal />
    @endpush
</x-app-layout>
