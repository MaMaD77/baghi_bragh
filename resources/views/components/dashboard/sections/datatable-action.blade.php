<div class="d-flex justify-content-end align-items-center d-none" data-kt-{{ $model }}-table-toolbar="selected">
    <div class="fw-bolder me-5">
        <span class="me-2" data-kt-{{ $model }}-table-select="selected_count"></span>Selected
    </div>
    {{-- <button type="button" class="btn btn-danger" data-kt-{{ $model }}-table-select="delete_selected">Delete Selected</button> --}}
    {{ $slot }}
</div>
