<x-dashboard.sections.card>

    <x-slot name="title">{{ $model }} {{ __('Timeline') }}</x-slot>

    <div class="timeline timeline-border-dashed p-5">
        @foreach ($statuses->reverse() as $pivotStatus)
            <div class="timeline-item">
                <div class="timeline-line"></div>

                <div class="timeline-icon" style="background-color: {{ $pivotStatus->status->badge_color }}; color: {{ $pivotStatus->status->text_color }}; opacity: 0.5">
                    <i class="{{ $pivotStatus->status->icon }}"></i>
                </div>

                <div class="timeline-content mb-5 mt-n1">
                    <div class="pe-3 mb-5">
                        <div class="fs-5 fw-semibold mb-2">
                            <strong>
                                {{ $pivotStatus->status->name }}
                            </strong>
                            @if (
                                ($pivotStatus->created_by_id == auth()->id() &&
                                    auth()->user()->can($pivotStatus->status->type . ':status:' . $pivotStatus->status->slug_name)) ||
                                    (auth()->user()->role->type == App\Enums\UserType::Admin || auth()->user()->role->type == App\Enums\UserType::Pricing))
                                <a href="javascript:void(0)" class="btn btn-icon btn-sm h-auto btn-color-gray-500 btn-active-color-primary justify-content-end edit-models-statuses-button float-end" data-id="{{ $pivotStatus->id }}" data-type="{{ $type ?? '' }}">
                                    <i class="fa fa-edit fs-2"></i>
                                </a>
                            @endif
                        </div>

                        <div class="d-flex align-items-center mt-1 fs-6">
                            <div class="text-muted me-2 fs-7">
                                <div class="d-flex flex-row gap-1">
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-100px px-7 py-1">
                                        <i class="fa fa-calendar me-2"></i>
                                        {{ $pivotStatus->created_at->format('Y-m-d') }}
                                    </div>
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-100px px-7 py-1">
                                        <i class="fa fa-clock me-2"></i>
                                        {{ $pivotStatus->created_at->format('h:i') }}
                                    </div>
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-100px px-7 py-1">
                                        <i class="fa fa-stopwatch me-2"></i>
                                        {{ $pivotStatus->duration_for_humans }}
                                    </div>
                                </div>
                                <div class="d-flex flex-row gap-1 mt-1 w-100">
                                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-100px px-7 py-1 w-100">
                                        <i class="fa fa-user me-2"></i>
                                        <a href="{{ route('user.show', $pivotStatus->createdBy->id) }}">{{ $pivotStatus->createdBy->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty(!$pivotStatus->note)
                        <div class="d-flex align-items-center border border-dashed border-info rounded min-w-100px px-7 py-3 mb-5">
                            <p class="fs-5 text-gray-900 fw-semibold w-375px min-w-100px m-0">{{ $pivotStatus->note }}</p>
                        </div>
                    @endempty

                    @if ($pivotStatus->files)
                        <livewire:dashboard.sections.show-files :files="$pivotStatus->files" />
                    @endif

                    <div class="separator separator-dashed separator-content border-dark my-5">
                        <span>
                            <i class="{{ $pivotStatus->status->icon }}"></i>
                        </span>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</x-dashboard.sections.card>
