<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

<link href="{{ asset('assets/vendor/filepond/filepond-plugin-image-preview.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/filepond/filepond.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/air-datepicker/air-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@if (session('locale.dir') == 'ltr')
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
@else
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.rtl.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container--open .select2-dropdown {
            transform: translate(100%, 0);
        }
    </style>
@endif


<style>
    :root {
        --custom-color-text: #000000;
    }

    html[data-bs-theme=dark] {
        --custom-color-text: #ffffff;
    }

    .form-control:not(textarea) {
        height: calc(1.5em + 1.1rem + 8px) !important;
    }

    .badge i {
        vertical-align: middle;
        color: inherit;
    }

    .cover {
        object-fit: cover;
    }

    th {
        background: #25367c !important;
        color: #ffffff !important;
        white-space: nowrap;
    }

    td {
        vertical-align: middle !important;
    }

    .table:not(.table-bordered) tr:first-child,
    .table:not(.table-bordered) th:first-child,
    .table:not(.table-bordered) td:first-child {
        padding-left: 1rem !important;
    }

    .table:not(.table-bordered) tr:last-child,
    .table:not(.table-bordered) th:last-child,
    .table:not(.table-bordered) td:last-child {
        padding-right: 1rem !important;
    }

    /* .table tr:first-child,
    .table th:first-child,
    .table td:first-child {
        border-left: 0 !important;
    }

    .table tr:last-child,
    .table th:last-child,
    .table td:last-child {
        border-right: 0 !important;
    } */

    .fab-color {
        color: #25367c
    }

    .contain {
        object-fit: contain;
    }

    .image-input,
    .image-input-wrapper {
        background-position: center !important;
        background-size: cover !important;
    }

    /* .form-control:disabled,
        .form-control[readonly] {
            background-color: #eff2f5 !important;
            opacity: 1;
        } */

    .air-datepicker-global-container {
        z-index: 1111;
    }

    .color-theme {
        color: #000000 !important;
    }

    html[data-bs-theme=dark] .color-theme {
        color: #ffffff !important;
    }

    .w-180px {
        width: 180px
    }

    .map-button {
        background: none padding-box rgb(255, 255, 255);
        display: table-cell;
        border: 0px;
        margin: 0px;
        padding: 0px 17px;
        text-transform: none;
        appearance: none;
        position: relative;
        cursor: pointer;
        user-select: none;
        overflow: hidden;
        text-align: center;
        height: 40px;
        vertical-align: middle;
        color: rgb(86, 86, 86);
        font-family: Roboto, Arial, sans-serif;
        font-size: 18px;
        font-weight: 500;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
        min-width: 64px;
        margin-top: 10px;
    }

    @media all {
        .app-container:has(.show-page) {
            padding-inline: 0px !important;
        }

        .show-page .container {
            max-width: unset !important;
        }

        .show-page .invoice-logo {
            width: 60%
        }

        .show-page .list-icon {
            font-size: 75px !important;
            color: #ffffff !important;
        }

        .show-page .title {
            font-size: 2.75rem;
            line-height: 1.3;
            font-weight: 600;
            color: white;
        }

        .show-page .item-no {
            font-size: 20px;
            color: #ffffff !important;
        }

        .show-page .bg-brand {
            background: #00109f !important
        }

        .show-page .bg-custom-gray {
            background: #e6e7e8 !important
        }

        .show-page .bg-custom-info {
            background: #00aeef !important;
            color: #ffffff
        }

        .show-page .font-lg {
            font-size: 25px;
            font-weight: 600
        }

        .show-page .font-md {
            font-size: 20px;
            font-weight: 600
        }

        .show-page .icon-circle {
            font-size: 2.50rem !important;
            color: black !important;
            vertical-align: middle;
        }

        .show-page .icon-circle-md {
            font-size: 25px !important;
            color: black !important;
            vertical-align: middle;
        }

        .show-page .border-lbrt {
            border: solid 2px #bcbec0 !important;
        }

        .show-page .border-lbr {
            border-inline: solid 2px #bcbec0 !important;
            border-bottom: solid 2px #bcbec0 !important;
        }

        .show-page .border-brt {
            border-right: solid 2px #bcbec0 !important;
            border-block: solid 2px #bcbec0 !important;
        }

        .show-page .border-br {
            border-right: solid 2px #bcbec0 !important;
            border-bottom: solid 2px #bcbec0 !important;
        }

        .show-page .border-b {
            border-bottom: solid 2px #bcbec0 !important;
        }

        .show-page .border-bt {
            border-block: solid 2px #bcbec0 !important;
        }

        .show-page .border-lr {
            border-inline: solid 2px #bcbec0 !important;
        }

        .show-page .border-r {
            border-right: solid 2px #bcbec0 !important;
        }

        .show-page .icon-md {
            font-size: 25px !important
        }

        .show-page .bg-custom-pink {
            background: #ec008c !important;
            color: #ffffff;
        }

        .show-page .bg-custom-success {
            background: #72bf44 !important;
            color: #ffffff
        }

        .show-page .bg-custom-warning {
            background: #f7941e !important;
            color: #ffffff
        }

        .show-page .fs-75px {
            font-size: 75px !important
        }

        .show-page .color-theme,
        .show-page .icon-circle,
        .show-page .icon-circle-md {
            color: #000000 !important;
        }

        .show-page .ellipsis-1-lines {
            -webkit-box-orient: vertical;
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 1;
        }
    }

    @media(max-width:1200px) {
        .show-page .list-icon {
            font-size: 60px !important;
        }

        .show-page .title {
            font-size: 2rem;
        }

        .show-page .font-lg {
            font-size: 17px;
        }

        .show-page .icon-circle {
            font-size: 1.5rem !important;
        }

        .show-page .font-md {
            font-size: 14px;
        }

        .show-page .icon-md {
            font-size: 20px !important;
        }

        .show-page .icon-circle-md {
            font-size: 20px !important;
        }

        .show-page .fs-75px {
            font-size: 60px !important;
        }
    }

    @media(max-width:1070px) {
        .show-page .list-icon {
            font-size: 50px !important;
        }

        .show-page .title {
            font-size: 1.5rem;
        }

        .show-page .font-lg {
            font-size: 14px;
        }

        .show-page .icon-circle {
            font-size: 1rem !important;
        }

        .show-page .font-md {
            font-size: 11px;
        }

        .show-page .icon-md {
            font-size: 16px !important;
        }

        .show-page .icon-circle-md {
            font-size: 16px !important;
        }

        .show-page .fs-75px {
            font-size: 45px !important;
        }

        .show-page .item-no {
            font-size: 15px
        }
    }

    @media(max-width:770px) {
        .show-page .d-sm-none-c {
            display: none
        }
    }

    @media(max-width:600px) {
        .show-page .list-icon {
            font-size: 20px !important;
        }

        .show-page .title {
            font-size: 1rem;
        }

        .show-page .font-lg {
            font-size: 10px;
        }

        .show-page .icon-circle {
            font-size: 0.5rem !important;
        }

        .show-page .font-md {
            font-size: 6px;
        }

        .show-page .icon-md {
            font-size: 10px !important;
        }

        .show-page .icon-circle-md {
            font-size: 10px !important;
        }

        .show-page .fs-75px {
            font-size: 30px !important;
        }

        .show-page .item-no {
            font-size: 10px
        }
    }

    html[data-bs-theme=dark] .show-page .bg-custom-gray {
        background: #1f2024 !important;
    }

    html[data-bs-theme=dark] .bg-white {
        background: #000000 !important;
    }

    html[data-bs-theme=dark] .show-page .color-theme,
    html[data-bs-theme=dark] .show-page .icon-circle,
    html[data-bs-theme=dark] .show-page .icon-circle-md {
        color: #ffffff !important;
    }

    .select2-container--bootstrap5 .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg) {
        padding-top: 0;
        padding-bottom: 0;
    }

    /* Customize Multiple Select Start */
    .non-selected-wrapper .selected {
        display: none !important;
    }

    .non-selected-wrapper .item,
    .selected-wrapper .item {
        -webkit-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
    }

    html[data-bs-theme=dark] .multi-wrapper .search-input {
        background: #15171c;
        border-bottom: 1px solid #363843;
    }

    html[data-bs-theme=dark] .multi-wrapper .non-selected-wrapper {
        background: #15171c;
        border-right: 1px solid #363843;
    }

    html[data-bs-theme=dark] .multi-wrapper .selected-wrapper {
        background: #15171c;
        border-right: 1px solid #363843;
    }


    html[data-bs-theme=dark] .multi-wrapper .item:hover {
        background: #252323de;
        border-radius: 2px;
    }

    html[data-bs-theme=dark] .multi-wrapper {
        border: 1px solid #363843;
    }

    html[data-bs-theme=dark] .multi-wrapper .header {
        color: #c1c1c1;
    }

    /* Customize Multiple Select End */


    .notification-image {
        width: 100%;
        height: 40px;
        object-fit: cover
    }

    .start-70 {
        left: 70% !important;
    }

    .top-10px {
        top: 10px !important;
    }

    @media (min-width: 992px) {
        .w-lg-450px {
            width: 450px !important;
        }
    }

    .w-200px {
        width: 200px;
    }

    .form-check-label .sub-label {
        font-size: 11px;
        color: inherit;
        line-height: 7px;
    }

    i.bi,
    i[class*=" fa-"],
    i[class*=" fonticon-"],
    i[class*=" la-"],
    i[class^=fa-],
    i[class^=fonticon-],
    i[class^=la-] {
        line-height: 1;
        font-size: unset;
        color: unset;
    }

    .ellipsis-1-line {
        -webkit-box-orient: vertical;
        display: -webkit-box;
        overflow: hidden;
        -webkit-line-clamp: 1;
    }

    .status-scroll {
        max-width: 100vw;
        overflow-x: scroll;
        overflow-y: hidden;
    }

    .status-scroll::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }

    .status-scroll::-webkit-scrollbar-thumb {
        background: #4aa3da;
        border-radius: 10px;
    }

    .status-list {
        display: flex;
        flex-wrap: wrap;
        width: max-content;
    }

    .inline-flex {
        display: inline-flex;
    }

    .max-h-350px {
        max-height: 350px
    }


    .select2-container--disabled .select2-selection--single {
        color: var(--bs-gray-500);
        background-color: var(--bs-gray-200);
        border-color: var(--bs-gray-300);
        opacity: 1;
    }

    .separator h4 {
        min-width: fit-content;
    }

    html[data-bs-theme=dark] .gm-style-iw {
        background: black
    }

    html[data-bs-theme=dark] .gm-style-iw-chr button {
        background: #464854 !important;
    }

    @keyframes fadeInSlideInRotateBounce {
        0% {
            opacity: 0;
            transform: translateX(-50px) rotate(-10deg) scale(0.8);
            filter: hue-rotate(0deg);
        }

        50% {
            opacity: 1;
            transform: translateX(10px) rotate(5deg) scale(1.1);
            filter: hue-rotate(45deg);
        }

        100% {
            opacity: 1;
            transform: translateX(0) rotate(0deg) scale(1);
            filter: hue-rotate(0deg);
        }
    }

    .dashboard-logo {
        animation: fadeInSlideInRotateBounce 2.5s ease-out forwards;
        content: url({{ asset(config('web.wordmark-dark')) }});
        max-width: -webkit-fill-available;
    }

    html[data-bs-theme=dark] .dashboard-logo {
        content: url({{ asset(config('web.wordmark-light')) }});
    }

    /* .ratio-dashboard-logo {
        width: 100%;
        padding-top: 19.8571%;
        position: relative;
    }

    @media (max-width: 550px) {
        .ratio-dashboard-logo {
            width: 100%;
            padding-top: 28.8571%;
            position: relative;
        }
    } */

    .pb-30 {
        padding-bottom: 7.5rem !important;
    }

    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }

    .vertical-text {
        writing-mode: vertical-lr;
        text-orientation: upright;
    }

    .l-s-20px {
        letter-spacing: 20px;
    }

    .l-s-10px {
        letter-spacing: 10px;
    }

    .c-bg-pink {
        background: #e22084;
        color: white;
        font-size: 23px;
        font-weight: 600;
        border-radius: 5px
    }

    .c-bg-blue {
        background: #1eb5c1;
        color: white;
        font-size: 23px;
        font-weight: 600;
        border-radius: 5px
    }

    .c-bg-red {
        background: #e22020;
        color: white;
        font-size: 23px;
        font-weight: 600;
        border-radius: 5px
    }

    .c-bg-green {
        background: #39a935;
        color: white;
        font-size: 23px;
        font-weight: 600;
        border-radius: 5px
    }

    input.form-control:read-only {
        color: var(--bs-gray-500);
        background-color: var(--bs-gray-200);
        border-color: var(--bs-gray-300);
        opacity: 1;
    }

    .vertical-align-middle {
        vertical-align: middle;
    }

    .border-radius-5px {
        border-radius: 5px
    }

    .w-110px {
        width: 110px !important
    }

    .max-w-50px {
        max-width: 50px !important;
    }

    .w-130px {
        width: 130px !important
    }
</style>

@stack('styles')
