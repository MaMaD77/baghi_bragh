<div {{ $attributes->merge(['class' => 'card'])->whereDoesntStartWith('wire:ignore') }}>
    @if (isset($title) || isset($toolbar))
        <div class="card-header align-items-center min-h-50px">
            <h2 class="card-title align-items-start flex-column fw-bold">
                {{ $title ?? '' }}

                <span class="text-muted mt-1 fw-semibold fs-7">{{ $subTitle ?? '' }}</span>
            </h2>
            <div class="card-toolbar">
                {{ $toolbar ?? '' }}
            </div>
        </div>
    @endif
    <div class="card-body p-0 {{ $bodyClass }}" {{ $attributes->whereStartsWith('wire:ignore') }}>
        {{ $slot }}
    </div>
</div>
