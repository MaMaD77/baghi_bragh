<div class="collapse border border-dashed rounded p-3 mb-4" id="kt-{{ $model }}-filter-collapse">
    <form id="{{ $model }}-filter-form" action="javascript:;" method="get">
        <div class="row g-3">
            {{ $slot }}

            <x-dashboard.fields.input type="text" id="{{ $model }}-created_at" name="created_at" cols="col-xl-3 col-lg-4 col-md-6 col-12" label="{{ __('Created at') }}" placeholder="{{ __('Created at') }}" autocomplete="off" :value="request()->query('created_at') ?? ''" />
        </div>

        <div class="text-end mt-8">
            <button type="reset" class="btn btn-danger me-3">{{ __('Reset') }}</button>
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">{{ __('Submit') }}</span>
                <span class="indicator-progress">{{ __('Please wait...') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            const t = document.querySelector("#{{ $model }}-created_at");
            $(t).flatpickr({
                altInput: true,
                altFormat: "Y-m-d",
                dateFormat: "Y-m-d",
                mode: "range"
            })
        });

        $(document).ready(function() {
            function getQueryParameters() {
                const params = new URLSearchParams(window.location.search);
                let queryParams = {};
                params.forEach((value, key) => {
                    if (queryParams[key]) {
                        if (Array.isArray(queryParams[key])) {
                            queryParams[key].push(value);
                        } else {
                            queryParams[key] = [queryParams[key], value];
                        }
                    } else {
                        queryParams[key] = value;
                    }
                });
                return queryParams;
            }

            function updateQueryStringParameter(key, value) {
                if (key === undefined) {
                    return; // Do not update if key is undefined
                }

                let url = new URL(window.location.href);
                let currentParams = getQueryParameters();

                // Remove existing parameters with the same key
                url.searchParams.delete(key);
                if (Array.isArray(value)) {
                    value.forEach(val => url.searchParams.append(key, val));
                } else if (value !== '') {
                    url.searchParams.set(key, value);
                }

                // Update URL only if there is a change
                if (JSON.stringify(currentParams[key]) !== JSON.stringify(value)) {
                    window.history.pushState({
                        path: url.href
                    }, '', url.href);
                }
            }

            function handleInputChange() {
                const $element = $(this);
                let value;

                if ($element.is('select[multiple]')) {
                    value = $element.val(); // jQuery .val() returns an array for multiple selects
                } else {
                    value = $element.val();
                }

                updateQueryStringParameter($element.attr('name'), value);
            }

            // Attach event listeners to form elements
            $('#{{ $model }}-filter-form').on('change input', 'input, select, textarea', handleInputChange);
        });
    </script>
@endpush
