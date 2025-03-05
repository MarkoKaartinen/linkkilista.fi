<div>

    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Linkit') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Hallitsi omia linkkejäsi.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>


    <div class="flex items-start max-md:flex-col gap-6 md:gap-12">
        <div class="flex-1 self-stretch max-md:pt-6">
            <div class="space-y-3">
                @foreach($links as $link)
                    <div class="border border-zinc-500 rounded-lg px-2 py-1 flex items-center justify-between" wire:key="link-{{ $link->id }}">
                        <div>
                            <flux:heading class="!mb-0">{{ $link->name }}</flux:heading>
                            <flux:subheading>{{ $link->url }}</flux:subheading>
                        </div>
                        <div class="flex gap-2">
                            <flux:button.group>
                                @if(!$loop->first)
                                    <flux:button wire:click="moveUp({{ $link->id }})" size="sm" square icon="chevron-up" />
                                @endif
                                @if(!$loop->last)
                                    <flux:button wire:click="moveDown({{ $link->id }})" size="sm" square icon="chevron-down" />
                                @endif
                            </flux:button.group>
                            <flux:modal.trigger :name="'delete-link-'.$link->id">
                                <flux:button size="sm" square variant="danger" icon="trash" />
                            </flux:modal.trigger>
                        </div>
                    </div>
                    <flux:modal :name="'delete-link-'.$link->id" class="md:w-96">
                        <form wire:submit="deleteLink({{ $link->id }})" class="space-y-6">
                            <div class="space-y-4">
                                <div>
                                    <flux:heading size="lg">{{ __('Haluatko varmasti poistaa linkin?') }}</flux:heading>

                                    <flux:subheading>
                                        {{ __('Linkin poistoa ei voi peruuttaa.') }}
                                    </flux:subheading>
                                </div>

                                <flux:spacer />

                                <div>
                                    <flux:heading class="!mb-0">{{ $link->name }}</flux:heading>
                                    <flux:subheading>{{ $link->url }}</flux:subheading>
                                </div>

                                <div class="flex justify-end space-x-2">
                                    <flux:modal.close>
                                        <flux:button variant="filled">{{ __('Peruuta') }}</flux:button>
                                    </flux:modal.close>

                                    <flux:button variant="danger" type="submit">{{ __('Poista linkki') }}</flux:button>
                                </div>
                            </div>
                        </form>
                    </flux:modal>
                @endforeach
            </div>
        </div>

        <flux:separator class="md:hidden" />

        <div class="w-full pb-4 md:w-1/3">
            <flux:heading level="2" size="lg">{{ __('Lisää linkki') }}</flux:heading>
            <flux:subheading class="mb-6">{{ __('Lisää linkki omaan linkkilistaasi.') }}</flux:subheading>

            <form wire:submit="createLink" class="flex flex-col gap-6">
                <flux:input wire:model="name" type="text" label="{{ __('Nimi') }}" />
                <flux:input wire:model="url" type="url" label="{{ __('Linkki') }}" />

                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">{{ __('Lisää linkki') }}</flux:button>
                    </div>

                    <x-action-message class="me-3" on="link-created">
                        {{ __('Lisätty.') }}
                    </x-action-message>
                </div>
            </form>
        </div>
    </div>

</div>
