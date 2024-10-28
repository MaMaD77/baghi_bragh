<div>
    <span class="badge" style="background-color:{{ $row->status?->badge_color }}; color: {{ $row->status?->text_color }}">
        <i class="{{ $row->status?->icon }} me-1"></i>
        {{ $row->status?->name }}
    </span>

    <div class="d-flex flex-column mt-2">
        <span class="text-nowrap">
            <i class="fa-solid fa-user"></i>
            {{ $row->statusUpdatedBy?->name }}
        </span>
    </div>
</div>
