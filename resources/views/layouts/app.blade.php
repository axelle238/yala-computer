<x-layouts::app.sidebar :title="$title ?? null">
    <div class="lg:px-8 lg:pt-4">
        <livewire:pencarian-global />
    </div>

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>