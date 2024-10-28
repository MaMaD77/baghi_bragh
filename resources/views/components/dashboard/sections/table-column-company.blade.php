<div class="d-flex align-items-center">
    <div class="d-flex align-items-center flex-grow-1">
        <a class="symbol symbol-45px me-5" data-fslightbox="company-image" data-type="image" href="{{ $row->company->image_url }}">
            <img class="cover" src="{{ $row->company->image_url }}">
        </a>
        <div class="d-flex flex-column">
            <span class="text-gray-900 fs-6 fw-bolder text-nowrap">{{ str($row->company->name)->limit(40) }}</span>
            <span class="text-muted fw-bold text-nowrap">{{ $row->company->id . ' - ' . $row->company->address->city?->name }}</span>
        </div>
    </div>
</div>
