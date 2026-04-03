@props(['name', 'title', 'description' => null, 'titleClass' => 'text-slate-900'])

<div
    x-data="{ show: false, name: '{{ $name }}' }"
    x-on:open-modal.window="if ($event.detail == name) { show = true; setTimeout(() => { $refs.modalContainer.querySelector('[autofocus]')?.focus() }, 100); }"
    x-on:close-modal.window="if ($event.detail == name) show = false"
    x-on:keydown.escape.window="show = false"
>
    <template x-teleport="body">
        <div
            x-ref="modalContainer"
            x-show="show"
            style="display: none;"
            class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
        >
            <div
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transform transition-all"
                x-on:click="show = false"
            >
                <div class="absolute inset-0 bg-gray-900 opacity-60 backdrop-blur-sm"></div>
            </div>

            <div
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative mb-6 bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto"
            >
                <div class="p-8">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold {{ $titleClass }}">
                            {{ $title }}
                        </h3>
                        @if($description)
                            <p class="mt-2 text-sm text-slate-500">
                                {{ $description }}
                            </p>
                        @endif
                    </div>

                    <div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>