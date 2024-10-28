<div class="d-flex align-items-center position-relative flex-wrap">
    <div class="my-1">
        <span class="svg-icon svg-icon-1 position-absolute ms-4 mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
            </svg>
        </span>
        <input type="text" data-kt-{{ $model }}-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('Search' . ' ' . Str::of($model)->title()->plural()) }}" value="{{ request()->query('search') }}" />
    </div>
    <button class="btn btn-icon btn-secondary ms-2 filter-buttons {{ !request()->has('show') ? 'active' : '' }}" id="{{ $model }}-button-filter-2" data-action="active-{{ $model }}" data-id="2">
        <i class="fa-solid fa-check">
        </i>
    </button>
    <button class="btn btn-icon btn-secondary ms-2 filter-buttons {{ request()->query('show') == 'passive' ? 'active' : '' }}" id="{{ $model }}-button-filter-3" data-action="passive-{{ $model }}" data-id="3">
        <i class="fa-solid fa-xmark">
        </i>
    </button>
    <button class="btn btn-icon btn-secondary ms-2 filter-buttons {{ request()->query('show') == 'all' ? 'active' : '' }}" id="{{ $model }}-button-filter-1" data-action="all-{{ $model }}" data-id="1">
        <i class="fa-solid fa-plus-minus">
        </i>
    </button>
</div>

<form id="{{ $model }}-filter-button-form" action="javascript:;" method="get">
    <x-dashboard.fields.input type="hidden" id="filter-show-{{ $model }}" name="show" cols="d-none" :value="request()->query('show')" />
</form>

@push('scripts')
    <script>
        $(document).on('click', '.filter-buttons', function() {
            let action = $(this).data('action');
            let id = $(this).data('id');
            let el = $('#filter-show-{{ $model }}');

            if (action == "active-{{ $model }}") {
                $('#filter-show-{{ $model }}').val('active');
            } else if (action == "passive-{{ $model }}") {
                $('#filter-show-{{ $model }}').val('passive');
            } else {
                $('#filter-show-{{ $model }}').val('all');
            }

            // Update the query string
            updateQueryStringParameter('show', el.val());

            // Remove active class from all filter buttons
            $('.filter-buttons').removeClass("active");

            // Add active class to the clicked button
            let element = document.getElementById(`{{ $model }}-button-filter-${id}`);
            element.classList.add("active");

            console.log($('#{{ $model }}-filter-button-form')[0]);
            $('#{{ $model }}-filter-button-form').submit();
        });

        function updateQueryStringParameter(key, value) {
            let url = new URL(window.location.href);

            // Remove all filter-related parameters
            url.searchParams.delete('show');

            // Set the new parameter if it's not empty
            if (value != 'active') {
                if (key && value !== '') {
                    url.searchParams.set(key, value);
                }
            }

            // Update URL only if there is a change
            if (url.search !== window.location.search) {
                window.history.pushState({
                    path: url.href
                }, '', url.href);
            }
        }
    </script>
@endpush
