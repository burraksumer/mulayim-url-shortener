<x-app-layout>
    <div
        class="container p-4 mx-auto"
        x-data="urlShortener()"
    >
        <h1 class="mb-4 text-2xl font-bold">Mülayim URL Shortener</h1>

        @if (session('shortened_url'))
            <x-success-alert
                successHeading="Shortened URL is:"
                successMessage="<a href='{{ htmlspecialchars(session('shortened_url')) }}' >{{ htmlspecialchars(session('shortened_url')) }}</a>"
            />
        @endif

        <form
            class="flex flex-col gap-4"
            action="{{ route('shorten.url') }}"
            method="POST"
        >
            @csrf
            <x-text-input
                name="original_url"
                type="url"
                x-model="originalUrl"
                placeholder="Enter your long URL"
                required
                @input="updatePredictedShortUrl()"
            />
            @auth
                <x-char-counter x-model="customShortCode" />
            @else
                <div class="flex flex-col">
                    <x-text-input
                        class="bg-gray-200 cursor-not-allowed"
                        id="custom-short-code"
                        name="custom_short_code"
                        type="text"
                        value=""
                        placeholder="Only logged in users change the custom URL."
                        readonly
                        x-model="customShortCode"
                    />
                    <span class="mt-1 text-sm text-gray-600">
                        <x-link href="login">Login</x-link> or
                        <x-link href="register">Register</x-link>
                        to enter a custom short URL.
                    </span>
                </div>
            @endauth
            @error('custom_short_code')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
            <x-v-button
                type="submit"
                variant="dark"
            >Shorten</x-v-button>
        </form>
    </div>

    <script>
        function urlShortener() {
            return {
                originalUrl: '',
                customShortCode: '',
                updatePredictedShortUrl() {
                    if (this.originalUrl.trim() === '') {
                        this.customShortCode = '';
                        return;
                    }
                    // Always generate a new short code on every input
                    this.customShortCode = this.generateDefaultShortCode();
                },
                generateDefaultShortCode() {
                    return Math.random().toString(36).substring(2, 8); // Generates a random string of 6 characters
                }
            }
        }
    </script>
</x-app-layout>
