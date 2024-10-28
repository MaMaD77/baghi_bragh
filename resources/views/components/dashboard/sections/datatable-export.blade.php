<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt-{{ $model }}-export-modal">
    <span class="svg-icon svg-icon-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
            <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
            <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="currentColor" />
        </svg>
    </span>
    Export
</button>

@push('modals')
    <div class="modal fade" id="kt-{{ $model }}-export-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h2 class="fw-bolder">Export {{ Str::of($model)->plural()->title() }}</h2>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y">
                    <form id="{{ $model }}-export-form" class="form" action="javascript:;" method="GET">
                        @csrf
                        <div class="row gy-5">
                            @php
                                $formats = [
                                    [
                                        'name' => 'CSV',
                                        'value' => 'csv',
                                    ],
                                    [
                                        'name' => 'Excel',
                                        'value' => 'xlsx',
                                    ],
                                ];
                            @endphp
                            @foreach ($formats as $key => $format)
                                <x-dashboard.fields.radio :id="'id' . $key" name="format" :value="$format['value']" :checked="old('format', 'csv') == $format['value'] ? true : false" cols="col mt-1" :label="$format['name']" />
                            @endforeach
                            {{-- <x-dashboard.fields.input type="text" name="created_at" :value="old('created_at')" cols="col-12" label="Created at range" placeholder="Created at range" /> --}}

                            {{ $slot }}
                        </div>
                        <div class="text-end mt-5">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" id="{{ $model }}-export-form-submit-button" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $(document).on('submit', '#{{ $model }}-export-form', function(e) {
            e.preventDefault();

            var thisButton = $('#{{ $model }}-export-form-submit-button');
            var thisForm = $(this);

            // thisButton.prop('disabled', true);

            var filterData = getFormData(
                $("#{{ $model }}-filter-form")
            );

            var filterTopData = getFormData(
                $("#{{ $model }}-filter-top-form")
            );

            var exportfilterData = getFormData(
                $(thisForm)
            );

            var filterAllData = {
                ...filterData,
                ...filterTopData,
                ...exportfilterData
            };

            // params = $.map(filterAllData, function(value, key) {
            //     return key + '=' + value
            // }).join('&');

            // $.each(filterAllData, function(key, value) {
            //     thisForm.append('<input type="hidden" id="' + key + '-export-filter" name="' + key + '" value="' + value + '">');
            // });

            // $(thisForm).attr('action', "{{ route('export.' . $model) }}?" + params);

            // thisButton.prop('disabled', false);

            // $(thisForm).submit();

            // $('#{{ $model }}-export-form > input[type="hidden"]').remove();

            axios.get('{{ route('export.' . $model) }}', {
                    params: filterAllData,
                    responseType: 'blob',
                })
                .then(function(response) {
                    if (response.data) {
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement("a");
                        link.href = url;
                        link.setAttribute("download", response.headers.filename);
                        document.body.appendChild(link);
                        link.click();
                    }

                    window.activateSubmitButton(thisForm.attr('id'));
                })
        });
    </script>
@endpush
