<a href="{{ route($model . '.create') }}" class="btn btn-primary">
    @include('components.dashboard.sections.plus-icon')
    Add {{ str($model)->title() }}
</a>
