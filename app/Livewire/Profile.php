<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.profile')]
class Profile extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.profile')
            ->title($this->user->name . ' - ' . config('app.name'));
    }

    public function mount($username)
    {
        $this->user = User::where('username', $username)
            ->with('links')
            ->firstOrFail();
    }
}
