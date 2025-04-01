<div class="relative">
    <x-filament::dropdown placement="bottom-end">
        <x-slot name="trigger">
            <button class="flex items-center space-x-2">
                <span>{{ app()->getLocale() === 'ru' ? 'Русский' : 'English' }}</span>
                <x-heroicon-o-chevron-down class="w-4 h-4" />
            </button>
        </x-slot>

        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item
                tag="a"
                href="{{ url('/set-locale/ru') }}"
            >
                 Русский
            </x-filament::dropdown.list.item>

            <x-filament::dropdown.list.item
                tag="a"
                href="{{ url('/set-locale/en') }}"
            >
                English
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
