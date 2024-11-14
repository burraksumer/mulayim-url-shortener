@props([
    'successMessage' => null,
    'successHeading' => null,
    'displayCopyButton' => true,
])

<div class="w-full p-4 mb-4 text-white bg-green-500 border border-transparent rounded-lg min-w-80">
    <div class="flex flex-row gap-2">
        <svg
            class="w-5 h-5 -translate-y-0.5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </svg>
        <h5 class="mb-1 font-medium leading-none tracking-tight">{{ $successHeading }}</h5>
    </div>
    <div class="flex flex-row gap-2">
        <div class="pl-7 text-md opacity-80">{!! $successMessage !!}</div>
        @if ($displayCopyButton)
            <button
                class="p-1 text-white transition duration-200 bg-transparent rounded-md hover:bg-white hover:text-green-500"
                onclick="copyToClipboard('{{ session('shortened_url') }}')"
            >
                <x-v-icon
                    class=""
                    name="copy"
                    width="20"
                    height="20"
                />
            </button>
        @endif
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Copied to clipboard: ' + text);
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
