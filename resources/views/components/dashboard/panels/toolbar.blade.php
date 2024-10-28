<div>
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $title }}</h1>
                @if (@isset($breadcrumbs))
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (isset($breadcrumb['link']))
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link'] : url($breadcrumb['link']) }}" class="text-muted text-hover-primary">
                                        {{ $breadcrumb['name'] }}
                                    </a>
                                </li>

                                @if (!$loop->last)
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                    </li>
                                @endif
                            @else
                                <li class="breadcrumb-item text-dark">
                                    {{ $breadcrumb['name'] }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endisset

        </div>
    </div>
</div>
