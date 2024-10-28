<div class="d-flex flex-column">
    <span class="text-nowrap">
        <i class="fa-solid fa-calendar"></i>
        {{ $datetime->format('Y-m-d') }}
    </span>
    @if ($datetime->format('H:i') != '00:00')
        <span class="text-nowrap">
            <i class="fa-solid fa-clock"></i>
            {{ $datetime->format('H:i') }}
        </span>
    @endif
</div>
