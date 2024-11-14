<x-app-layout>
    <div
        class="container p-4 mx-auto"
        x-data="urlEditor()"
    >
        <h1 class="mb-4 text-2xl font-bold text-center">Edit Shortened URL</h1>

        <form
            class="flex flex-col gap-4"
            action="{{ route('update.url', $url->id) }}"
            method="POST"
        >
            @csrf
            @method('PATCH')
            <input
                name="id"
                type="hidden"
                value="{{ $url->id }}"
            >

            <x-text-input
                class="bg-gray-200 cursor-not-allowed"
                name="original_url"
                type="text"
                value="{{ $url->original_url }}"
                readonly
                placeholder="Original URL"
            />

            <x-char-counter x-model="customShortCode" />
            @error('custom_short_code')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror

            <x-v-button
                type="submit"
                variant="dark"
            >Update</x-v-button>
        </form>
    </div>

    <script>
        function urlEditor() {
            return {
                customShortCode: '{{ $url->short_url }}', // Initialize with the current short code
                updateShortUrl() {
                    const baseUrl = "{{ url('') }}"; // Get the base URL
                    const shortUrlDisplay = document.getElementById('short-url-display'); // Get the display element

                    // Update the displayed short URL
                    shortUrlDisplay.value = `${baseUrl}/${this.customShortCode}`; // Update the value of the input
                }
            }
        }
    </script>
</x-app-layout>
