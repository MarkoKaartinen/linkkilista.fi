<?php

namespace App\Livewire;

use App\Models\Link;
use Livewire\Component;

class Links extends Component
{
    public string $name = '';
    public string $url = 'https://';

    public int $selectedLink;

    public function render()
    {
        return view('livewire.links', [
            'links' => auth()->user()->links
        ]);
    }

    public function moveDown($linkid)
    {
        $link = Link::where('id', $linkid)->first();
        if($link->user_id != auth()->user()->id){
            abort(403);
        }
        $link->moveOrderDown();
    }

    public function moveUp($linkid)
    {
        $link = Link::where('id', $linkid)->first();
        if($link->user_id != auth()->user()->id){
            abort(403);
        }
        $link->moveOrderUp();
    }

    public function deleteLink($linkid)
    {
        $link = Link::where('id', $linkid)->first();
        if($link->user_id != auth()->user()->id){
            abort(403);
        }
        $link->delete();
        $this->modal('delete-link-'.$linkid)->close();
    }

    public function createLink()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
        ]);

        auth()->user()->links()->create($validated);

        $this->reset(['name', 'url']);
        $this->dispatch('link-created');
    }
}
