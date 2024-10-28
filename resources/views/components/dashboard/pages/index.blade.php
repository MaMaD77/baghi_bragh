<x-guest-layout>
    <div class="w-100 h-100" style="align-content: center;place-items: center;">
        <div class="card rounded-4 w-md-600px p-10">
            <div class="card-body">
                <div class="text-center">
                    <a href="index.html">
                        <img alt="Logo" src="{{ asset(config('web.wordmark-light')) }}" class="w-150px">
                    </a>
                </div>

                <a href="{{ route('project.index') }}" class="btn btn-primary w-100 mt-10">
                    <i class="ki-duotone ki-badge fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> CLick to input data
                </a>

                <a href="{{ route('draw') }}" class="btn btn-primary w-100 mt-4">
                    <i class="ki-duotone ki-abstract-39 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> click to Draw
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
