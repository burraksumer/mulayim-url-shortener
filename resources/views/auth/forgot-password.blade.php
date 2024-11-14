<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">{{ __('Forgot Password') }}</h2>

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')"
                    />

                    <form
                        method="POST"
                        action="{{ route('password.email') }}"
                    >
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label
                                for="email"
                                :value="__('Email')"
                            />
                            <x-text-input
                                class="block w-full mt-1"
                                id="email"
                                name="email"
                                type="email"
                                :value="old('email')"
                                required
                                autofocus
                                placeholder="john@doe.com"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('email')"
                            />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <x-v-button type="submit">
                                {{ __('Email Password Reset Link') }}
                            </x-v-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
