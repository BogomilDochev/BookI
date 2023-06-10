<x-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <x-form.input name="email" type=email" required autofocus/>

            <!-- Password -->
            <x-form.input name="password" type=password" required/>

            <!-- Confirm Password -->
            <x-form.input name="password_confirmation" type=password" label="Confirm Password" required/>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>

    <x-footer />
</x-layout>
