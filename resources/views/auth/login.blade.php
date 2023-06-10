    <x-layout>
    <x-dark-mode-toggle top="top-4" />

    <x-auth-card>
        <x-slot name="logo">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <x-form.input name="email" type="email" required autofocus/>

            <!-- Password -->
            <x-form.input name="password" type="password" required autocomplete="current-password"/>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-white">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-white dark:hover:text-blue-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            <div class="flex items-center justify-end mt-2">
                <a class="bg-gray-500 p-1.5 rounded-md text-white" href="{{ route('google.login') }}" >
                    {{ __('Login with Google') }}
                </a>
            </div>
        </form>
    </x-auth-card>

    <x-footer />
</x-layout>
