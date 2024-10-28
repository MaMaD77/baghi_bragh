<div class="d-flex align-items-center">
    <div class="d-flex align-items-center flex-grow-1">
        <a class="symbol symbol-45px me-5" data-fslightbox="lightbox-dev" href="{{ $avatar }}">
            <img class="cover" src="{{ $avatar }}">
        </a>
        <div class="d-flex flex-column">
            <span class="text-gray-900 fs-6 fw-bolder">{{ str($name)->limit(40) }}</span>
            <span>{{ $subtitle ?? '' }}</span>
        </div>
    </div>
</div>
