<x-dashboard.sections.modal id="{{ $action }}-modal" title="{{ __('Edit User', ['id' => $user?->id]) }}" class="modal-lg">

    @include('components.dashboard.models.user.forms.create-edit')

</x-dashboard.sections.modal>

@push('scripts')
    <script>
        $(document).on('click', '.{{ $action }}-button', function() {
            let id = $(this).data('id');
            @this.call('showModal', id);
        });

        window.addEventListener('showEditUserModal', event => {
            $('#{{ $action }}-modal').modal('show')
        });

        window.addEventListener('hideEditUserModal', event => {
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
