<x-layout.app>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-3">
            <x-profile-sidebar />
        </div>
        <div class="col-span-9">
            <div class="flex flex-col gap-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layout.app>
