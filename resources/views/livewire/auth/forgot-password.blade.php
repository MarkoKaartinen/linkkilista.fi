<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('Salasanan nollauslinkki lähetetään sähköpostiin, jos sellainen on olemassa.'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header title="Unohtuiko salasana?" description="Syötä sähköpostisi saadaksesi salasanan palautuslinkki" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            label="{{ __('Sähköposti') }}"
            type="email"
            name="email"
            required
            autofocus
            placeholder="email@example.com"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Lähetä linkki') }}</flux:button>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-400">
        <flux:link href="{{ route('login') }}" wire:navigate>Kirjaudu sisään</flux:link> tai
        <flux:link href="{{ route('register') }}" wire:navigate>Luo tunnus</flux:link>
    </div>
</div>
