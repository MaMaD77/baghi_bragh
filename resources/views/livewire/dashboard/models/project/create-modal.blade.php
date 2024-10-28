<x-dashboard.sections.modal id="{{ $action }}-modal" title="{{ __('Create Project') }}" class="modal-lg">

    @include('components.dashboard.models.project.forms.create-edit')

</x-dashboard.sections.modal>

@push('scripts')
    <script>
        $(document).on('click', '.{{ $action }}-button', function() {
            @this.call('showModal');
        });

        window.addEventListener('showCreateProjectModal', event => {
            $('#{{ $action }}-modal').modal('show')
        });

        window.addEventListener('hideCreateProjectModal', event => {
            $('#{{ $action }}-modal').modal('hide')
            if (event.detail.error) {
                Swal.fire(
                    'Error!',
                    event.detail.error,
                    'error'
                )
            } else {
                if (typeof projectDataTable !== 'undefined' && projectDataTable != null) {
                    projectDataTable.ajax.reload(null, false);
                }
            }
        });
    </script>
@endpush
