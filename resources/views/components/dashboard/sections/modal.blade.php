<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog {{ $class }}">
        <div id="{{ $id }}-content" class="modal-content rounded">
            <div class="modal-header p-3">
                <h2 class="fw-bolder">{{ $title }}</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
