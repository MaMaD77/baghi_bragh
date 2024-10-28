<x-dashboard.sections.modal id="{{ $action }}-modal" title="{{ __('Create User') }}" class="modal-lg">

    @include('components.dashboard.models.user.forms.create-edit')

</x-dashboard.sections.modal>

@push('scripts')
    <script>
        $(document).on('click', '.{{ $action }}-button', function() {
            @this.call('showModal');
        });

        window.addEventListener('showCreateUserModal', event => {
            $('#{{ $action }}-modal').modal('show')
        });

        window.addEventListener('hideCreateUserModal', event => {
            $('#{{ $action }}-modal').modal('hide')
            if (event.detail.error) {
                Swal.fire(
                    'Error!',
                    event.detail.error,
                    'error'
                )
            } else {
                if (typeof userDataTable !== 'undefined' && userDataTable != null) {
                    userDataTable.ajax.reload(null, false);
                }
            }
        });
    </script>
@endpush
