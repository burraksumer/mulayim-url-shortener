<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">{{ __('Login') }}</h2>

                    <!-- Session Status -->
                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')"
                    />

                    <form
                        method="POST"
                        action="{{ route('login') }}"
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
                                autocomplete="username"
                                placeholder="john@doe.com"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('email')"
                            />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label
                                for="password"
                                :value="__('Password')"
                            />
                            <x-text-input
                                class="block w-full mt-1"
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="supersecretpassword"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('password')"
                            />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label
                                class="inline-flex items-center"
                                for="remember_me"
                            >
                                <input
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-neutral-900 focus:ring-neutral-900"
                                    id="remember_me"
                                    name="remember"
                                    type="checkbox"
                                >
                                <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            @if (Route::has('password.request'))
                                <x-link
                                    className="text-sm text-gray-600 underline"
                                    href="password.request"
                                >
                                    {{ __('Forgot your password?') }}
                                </x-link>
                            @endif

                            <x-v-button
                                class="w-2/4 ms-3"
                                type="submit"
                            >
                                {{ __('Log in') }}
                            </x-v-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
