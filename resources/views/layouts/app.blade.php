<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" direction="{{ session('locale.dir') }}" dir="{{ session('locale.dir') }}" style="direction: {{ session('locale.dir') }}">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="{{ config('web.description') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="vapid-public-key" content="{{ config('webpush.vapid.public_key') }}">

    <meta name="google-maps-api-key" content="{{ config('services.google-map.key') }}">

    <meta name="reverb-app-is-enabled" content="{{ config('reverb.apps.apps.0.is-enabled') }}">
    <meta name="reverb-app-key" content="{{ config('reverb.apps.apps.0.key') }}">
    <meta name="reverb-app-host" content="{{ config('reverb.apps.apps.0.options.host') }}">
    <meta name="reverb-app-port" content="{{ config('reverb.apps.apps.0.options.port') }}">
    <meta name="reverb-app-scheme" content="{{ config('reverb.apps.apps.0.options.scheme') }}">

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="{{ asset(config('web.android-chrome-384x384')) }}" />
    <meta property="og:title" content="{{ config('app.name') . (isset($title) ? ' | ' . $title : '') }}" />
    <meta property="og:description" content="{{ config('web.description') }}" />

    <title>{{ config('app.name') . (isset($title) ? ' . ' . $title : '') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(config('web.apple-touch-icon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('web.favicon-32x32')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('web.favicon-16x16')) }}">
    <link rel="manifest" href="{{ asset(config('web.webmanifest')) }}">
    <link rel="mask-icon" href="{{ asset(config('web.safari-pinned-tab')) }}" color="{{ config('web.theme-color') }}">
    <meta name="msapplication-TileColor" content="{{ config('web.theme-color') }}">
    <meta name="theme-color" content="{{ config('web.theme-color') }}">

    @include('components.dashboard.panels.styles')

    <script>
        window.selectAjaxDelay = 0;
    </script>

    @vite('resources/js/app.js')
</head>


<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->


    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            @include('components.dashboard.panels.header')

            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                @include('components.dashboard.panels.sidebar')

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">

                        <x-dashboard.panels.toolbar :title="$title" :breadcrumbs="$breadcrumbs" />

                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                {{ $slot }}
                            </div>
                        </div>

                    </div>
                </div>

                @include('components.dashboard.panels.footer')

            </div>
        </div>
    </div>

    @stack('modals')

    @include('components.dashboard.panels.scripts')
</body>

</html>
