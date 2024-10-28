<table class="table align-middle table-row-dashed fs-6 gy-5" id="project-table">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <x-dashboard.fields.checkbox id="select-all-project" cols="col-12" />
            </th>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Profile') }}</th>
            <th>{{ __('Width Top') }}</th>
            <th>{{ __('Width Bottom') }}</th>
            <th>{{ __('Height Inside') }}</th>
            <th>{{ __('Height Outside') }}</th>
            <th>{{ __('Note') }}</th>
            <th>{{ __('Created at') }}</th>
            <th>{{ __('Active') }}</th>
            <th class="text-end w-10px"><i class="fa fa-ellipsis-h"></i></th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
    </tbody>
</table>

@push('scripts')
    <script>
        $(document).ready(function() {
            let columns = [{
                    data: 'select',
                    name: 'select',
                    label: 'Select',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'id',
                    name: 'id',
                    label: 'ID',
                },
                {
                    data: 'name',
                    name: 'name',
                    label: 'Name',
                },
                {
                    data: 'profile_type',
                    name: 'profile_type',
                    label: 'Type',
                },
                {
                    data: 'profile',
                    name: 'profile',
                    label: 'Profile',
                },
                {
                    data: 'width_top_inside',
                    name: 'width_top_inside',
                    label: 'Width Top',
                },
                {
                    data: 'width_down_inside',
                    name: 'width_down_inside',
                    label: 'Width Bottom',
                },
                {
                    data: 'height_inside',
                    name: 'height_inside',
                    label: 'Height Inside',
                },
                {
                    data: 'height_outside',
                    name: 'height_outside',
                    label: 'Height Outside',
                },
                {
                    data: 'note',
                    name: 'note',
                    label: 'Note',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    label: 'Created at',
                },
                {
                    data: 'deleted_at',
                    name: 'deleted_at',
                    label: 'Active',
                }
            ]

            DEVDatatable.init(
                'project',
                "{{ route('project.index') }}",
                columns,
                true,
                [1, 'desc']
            );
        });
    </script>
@endpush
