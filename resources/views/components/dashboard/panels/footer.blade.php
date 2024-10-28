<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">
                <a href="{{ config('app.url') }}" target="_blank" class="text-gray-800 text-hover-primary">{{ config('app.name') }}</a> ©
            </span>
            {{ config('web.developed-at') }},
            {{ __('All Rights Reserved.') }}
        </div>
        <div class="fw-bold order-1">
            <span class="text-muted">{{ __('Developed by') }}</span>
            <a href="{{ config('web.developed-by-url') }}" target="_blank" class="text-gray-800 text-hover-primary">{{ config('web.developed-by-name') }}</a>
        </div>
    </div>
</div>
