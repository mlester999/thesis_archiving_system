<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        <div class="relative flex flex-col m-6 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
        <!-- Left Side -->
        <a href="/" class="absolute left-6 top-5 text-lg"><i class="fa-solid fa-arrow-left fa-xl hover:text-slate-500 duration-200"></i></a>
        <div class="p-6 md:p-16">
        <!-- Top Content -->
        <h2 class="font-sans mb-5 text-4xl font-bold">Log In</h2>
        <p class="max-w-sm font-sans font-light text-gray-600">
          Please log in your student account.
        </p>
        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Student ID -->
                <x-input-label class="mt-8" for="student_id" :value="__('Student ID')" />

                <x-text-input id="student_id" class="mt-1 w-full" type="text" name="student_id" :value="old('student_id')" required autofocus />

                <x-input-error :messages="$errors->get('student_id')" class="mt-2" />

            <!-- Password -->
                <x-input-label class="mt-4" for="password" :value="__('Password')" />

                <x-text-input id="password" class="mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Remember Me -->
            <div class="mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col mx-auto items-center justify-between mt-6 mb-2 space-y-6 md:flex-row md:space-y-0">
                @if (Route::has('password.request'))
                    <a class="font-thin mr-24 text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button>
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
          src="images/library.jpg"
          alt=""
          class="w-[430px] hidden md:block rounded-r-2xl"
        />
    </div>
    </x-auth-card>
</x-guest-layout>
