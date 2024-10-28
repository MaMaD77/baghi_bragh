<div class="d-flex align-items-center">
    <div class="d-flex align-items-center flex-grow-1">
        @if ($row->variant)
            <a class="symbol symbol-45px me-5" data-fslightbox="product-image" data-type="image" href="{{ $row->variant->image_url }}">
                <img class="cover" src="{{ $row->variant->image_url }}">
            </a>
            <div class="d-flex flex-column">
                <span class="text-gray-900 fs-6 fw-bolder text-nowrap">{{ str($row->product->name)->limit(40) . ' | ' . $row->variant->detail }}</span>
                <span class="text-muted fw-bold">#{{ $row->product->id }}</span>
            </div>
        @else
            <a class="symbol symbol-45px me-5" data-fslightbox="product-image" data-type="image" href="{{ $row->product->image_url }}">
                <img class="cover" src="{{ $row->product->image_url }}">
            </a>
            <div class="d-flex flex-column">
                <span class="text-gray-900 fs-6 fw-bolder text-nowrap">{{ str($row->product->name)->limit(40) }}</span>
                <span class="text-muted fw-bold">#{{ $row->product->id }}</span>
            </div>
        @endif
    </div>
</div>
