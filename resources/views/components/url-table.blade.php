<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-neutral-200/70">
                    <thead>
                        <tr class="text-neutral-800">
                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Short URL</th>
                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Original URL</th>
                            <th class="px-5 py-3 text-xs font-medium text-center uppercase">Clicks</th>
                            <th class="px-5 py-3 text-xs font-medium text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200/70">
                        @foreach ($urls as $url)
                            <tr class="text-neutral-600 bg-neutral-50">
                                <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                    <x-link external="{{ url($url->short_url) }}">
                                        {{ url($url->short_url) }}
                                    </x-link>
                                </td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">
                                    <x-link external="{{ url($url->original_url) }}">
                                        {{ url($url->original_url) }}
                                    </x-link>
                                </td>
                                <td class="px-5 py-4 text-sm text-center whitespace-nowrap">
                                    {{ $url->click_count }} <!-- Display click count -->
                                </td>
                                <td
                                    class="flex items-center justify-center px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <!-- Edit Button -->
                                    <x-link
                                        title="Edit"
                                        external="{{ route('edit.url', $url->id) }}"
                                    >
                                        <x-v-icon
                                            name="pen"
                                            width="20"
                                            height="20"
                                        />
                                    </x-link>
                                    <!-- Remove Button -->
                                    <form
                                        class="inline-block"
                                        action="{{ route('remove.url', $url->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this URL?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            title="Remove"
                                        >
                                            <x-v-icon
                                                name="trash"
                                                width="20"
                                                height="20"
                                            />
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
