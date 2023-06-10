<x-layout>
    <div class="font-sans text-gray-900 antialiased">
        <x-dark-mode-toggle top="top-4" />

        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <x-form.input name="name" type="text" required autofocus/>

                {{-- Avatar --}}
                <div class="mt-4">
                    <x-form.input-label for="avatar">Choose an avatar</x-form.input-label>
                    <div class="grid grid-cols-6">

                        <?php for ($i = 1; $i < 9; $i++) : ?>
                            <x-form.avatar name="avatar{{ $i }}" />
                        <?php endfor; ?>

                    </div>
                    <x-form.input-error name="avatar"/>
                </div>

                <!-- Email -->
                <x-form.input name="email" type="email" required/>

                <!-- Password -->
                <x-form.input name="password" type="password" required autocomplete="new-password"/>
                <div>
                    <p>The password must contain the following:</p>
                    <ul class="list-disc ml-7">
                        <li>Minimum 8 characters</li>
                        <li>A capital (uppercase) letter</li>
                        <li>A lowercase letter</li>
                        <li>A number</li>
                    </ul>
                </div>


                <!-- Confirm Password -->
                <x-form.input name="password_confirmation" type="password" label="Confirm Password" required/>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-white dark:hover:text-blue-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </x-auth-card>
    </div>
    <x-footer />
</x-layout>
