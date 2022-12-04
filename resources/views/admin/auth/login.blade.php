<x-admin-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        @php
            if (count($errors) > 0) {
                $loginError = collect($errors->default)->sortBy('key');
                $loginKeys = $loginError->keys();

                if(array_key_exists('username', $loginError->toArray())) {
                    if(str_contains($loginError['username'][0], 'Too many login attempts.')) {
                        RealRashid\SweetAlert\Facades\Alert::error("Too Many Login Attempts", "Please wait for 60 seconds.")->showConfirmButton('OK', '#2678c5')->width('420px')->autoClose(5000);
                    } else {
                        RealRashid\SweetAlert\Facades\Alert::error("Login Failed", "These credentials do not match our records.")->showConfirmButton('Okay', '#2678c5')->width('420px')->autoClose(5000);
                    }
                } else {
                    RealRashid\SweetAlert\Facades\Alert::error("Login Failed", "These credentials do not match our records.")->showConfirmButton('Okay', '#2678c5')->width('420px')->autoClose(5000);
                }
            }
        @endphp

        <div class="relative flex flex-col mx-6 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
        <a href="/" class="absolute left-6 top-4 text-lg"><i class="fa-solid fa-arrow-left fa-lg md:fa-xl hover:text-slate-500 duration-200"></i></a>
        <!-- Left Side -->
        <div class="px-12 pt-6 pb-8 md:px-16 md:py-16">
        <!-- Top Content -->
        <h2 class="font-sans mb-4 md:mb-5 text-3xl md:text-4xl font-bold">Log In</h2>
        <p class="max-w-sm font-sans text-sm md:text-base font-light text-gray-600">
          Please log in your admin account.
        </p>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form x-data="{ buttonDisabled: false }" x-on:submit="buttonDisabled = true" method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Username -->
                <x-input-label class="mt-8" for="username" :value="__('Username')" />

                <x-text-input id="username" class="mt-1 w-full" type="text" name="username" :value="old('username')" autofocus />

                {{-- <x-input-error :messages="$errors->get('username')" class="mt-2" /> --}}

            <!-- Password -->
                <x-input-label class="mt-4" for="password" :value="__('Password')" />

                <x-text-input id="password" class="mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="current-password" />

                {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}

            <!-- Remember Me -->
            <div class="mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col mx-auto items-left lg:items-center justify-between mt-2 md:mt-6 mb-2 space-y-6 lg:flex-row lg:space-y-0">
                @if (Route::has('admin.password.request'))
                    <a class="font-thin sm:mr-72 md:ml-0 md:mr-0 lg:ml-0 lg:mr-24 text-blue-500 hover:text-opacity-80 text-sm" href="{{ route('admin.password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' ">
                    {{ __('Enter') }}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="ml-1 w-7"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="#ffffff"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <line x1="13" y1="18" x2="19" y2="12" />
                        <line x1="13" y1="6" x2="19" y2="12" />
                    </svg>
                </x-primary-button>
            </div>
            </form>
        </div>
        <!-- Right Side -->
        <img
          src="/images/library.jpg"
          alt=""
          class="xl:w-96 md:w-80 hidden md:block rounded-r-2xl"
        />
    </div>
    </x-auth-card>
</x-admin-guest-layout>
