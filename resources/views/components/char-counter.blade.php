@props([
    'maxChars' => 10,
])

<div class="flex flex-col mt-2">
    <x-text-input
        name="custom_short_code"
        x-model="customShortCode"
        maxlength="{{ $maxChars }}"
        placeholder="Enter custom short code (optional)"
    />
    <span
        class="mt-1 ml-1 text-sm text-gray-600"
        x-text="`${customShortCode.length} / {{ $maxChars }}`"
    ></span>
</div>
