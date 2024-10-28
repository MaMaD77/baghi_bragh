<x-dashboard.sections.modal id="{{ $action }}-modal" title="{{ __('Edit Project', ['id' => $project?->id]) }}" class="modal-lg">

    @include('components.dashboard.models.project.forms.create-edit')

</x-dashboard.sections.modal>

@push('scripts')
    <script>
        $(document).on('click', '.{{ $action }}-button', function() {
            let id = $(this).data('id');
            @this.call('showModal', id);
        });

        window.addEventListener('showEditProjectModal', event => {
            $('#{{ $action }}-modal').modal('show')
        });

        window.addEventListener('hideEditProjectModal', event => {
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
