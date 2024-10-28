<table class="table align-middle table-row-dashed fs-6 gy-5" id="user-table">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <x-dashboard.fields.checkbox id="select-all-user" cols="col-12" />
            </th>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
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
                    data: 'email',
                    name: 'email',
                    label: 'Email',
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
                'user',
                "{{ route('user.index') }}",
                columns,
                true,
                [1, 'desc']
            );
        });
    </script>
@endpush
