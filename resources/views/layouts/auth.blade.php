<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link rel="manifest" href="{{ config('web.webmanifest') }}">
    <link rel="mask-icon" href="{{ config('web.safari-pinned-tab') }}" color="{{ config('web.theme-color') }}">
    <meta name="msapplication-TileColor" content="{{ config('web.theme-color') }}">
    <meta name="theme-color" content="{{ config('web.theme-color') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .ratio-1-1 {
            width: 100%;
            padding-top: 100%;
            position: relative;
        }

        .ratio-21-9 {
            width: 100%;
            padding-top: 42.8571%;
            position: relative;
        }

        .ratio-16-9 {
            width: 100%;
            padding-top: 56.25%;
            position: relative;
        }

        .ratio-4-3 {
            width: 100%;
            padding-top: 75%;
            position: relative;
        }

        .ratio-3-2 {
            width: 100%;
            padding-top: 66.66%;
            position: relative;
        }

        .ratio-3-1 {
            width: 100%;
            padding-top: 33.33%;
            position: relative;
        }

        .ratio-8-5 {
            width: 100%;
            padding-top: 62.5%;
            position: relative;
        }

        .ratio-container {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        .cover {
            object-fit: cover;
        }
    </style>

    {{-- <style>
        body {
            background-image: url({{ asset('assets/media/auth/bg4.jpg') }});
        }

        [data-theme="dark"] body {
            background-image: url({{ asset('assets/media/auth/bg4-dark.jpg') }});
        }
    </style> --}}
</head>


<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">

    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->

    <div class="d-flex flex-column flex-root" id="kt_app_root">
        {{ $slot }}
    </div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    @livewireScripts

    @stack('scripts')
</body>

</html>
