<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="flex flex-col items-start">
    @include('partials.settings-heading')

    <x-settings.layout heading="{{ __('Ulkoasu') }}" subheading="{{ __('Päivitä tilisi ulkoasuasetuksia') }}">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Vaalea') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Tumma') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('Järjestelmä') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</div>
