<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public null|string $description = '';

    public $avatar;

    public string $avatarUrl = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->description = $user->description;
        $this->avatarUrl = $user->hasMedia('avatar') ? $user->getFirstMedia('avatar')->getAvailableFullUrl(['small']) : '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],

            'description' => ['nullable', 'string'],
        ];

        if($this->avatar){
            $rules['avatar'] = ['image', 'max:2048'];
        }

        $validated = $this->validate($rules);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if($this->avatar){
            $user->addMedia($this->avatar)
                ->toMediaCollection('avatar');
        }

        $this->avatarUrl = $user->hasMedia('avatar') ? $user->getFirstMedia('avatar')->getAvailableFullUrl(['small']) : '';

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout heading="{{ __('Profiili') }}" subheading="{{ __('Päivitä profiilisi tiedot alla.') }}">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            @if($avatarUrl)
                <img class="size-30 rounded-full border-2 border-accent" src="{{ $avatarUrl }}" alt="{{ $name }} avatar" />
            @endif
            <flux:input type="file" wire:model="avatar" label="{{ __('Uusi avatar') }}"/>

            <flux:input wire:model="name" label="{{ __('Nimi') }}" type="text" name="name" required autocomplete="name" />

            <flux:textarea
                wire:model="description"
                label="{{ __('Kuvaus') }}"
                placeholder="{{ __('Kirjoita lyhyt kuvaus itsestäsi.') }}"
            />

            <div>
                <flux:input wire:model="email" label="{{ __('Sähköposti') }}" type="email" name="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <p class="mt-2 text-sm text-gray-800">
                            {{ __('Sähköpostiasi ei ole vahvistettu.') }}

                            <button
                                wire:click.prevent="resendVerificationNotification"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                {{ __('Klikkaa tästä lähettääksesi vahvistussähköpostin.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-green-600">
                                {{ __('Uusi vahvistuslinkki on lähtetty sähköpostiisi.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Tallenna') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Tallennettu.') }}
                </x-action-message>
            </div>
        </form>

        {{-- TODO
        <livewire:settings.delete-user-form />
        --}}
    </x-settings.layout>
</section>
