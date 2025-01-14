<x-auth-layout>
    <div class="d-flex flex-column flex-root">
        <style>
            body {
                background-image: url("assets/media/auth/bg10.jpeg");
            }

            [data-bs-theme="dark"] body {
                background-image: url("assets/media/auth/bg10-dark.jpeg");
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency.png" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="assets/media/auth/agency-dark.png" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                        Fast, Efficient and Productive
                    </h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        In this kind of post,
                        <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed <br />and provides some
                        background information about
                        <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their <br />work following this is a transcript of the
                        interview.
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form class="form w-100" novalidate="novalidate" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Login</h1>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" id="email" name="email" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" id="password" name="password" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div>
                                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="remember" value="1" />
                                            <span class="form-check-label fw-bold text-gray-700 fs-6">Remember Me</span>
                                        </label>

                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="link-primary">Forgot Password ?</a>
                                    @endif
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Login</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                {{-- <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Not a Member yet?
                                    <a href="{{ route('register') }}" class="link-primary">Register</a>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
