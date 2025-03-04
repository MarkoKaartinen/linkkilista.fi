<div>
    <div class="mx-auto max-w-md w-full px-6">
        <div>
            @if($user->hasMedia('avatar'))
                <img class="mx-auto size-40 rounded-full border-accent border-2" src="{{ $user->getFirstMedia('avatar')->getAvailableFullUrl(['medium']) }}" alt="{{ $user->name }} avatar" />
            @else
                <span class="relative flex size-40 shrink-0 overflow-hidden rounded-full border-accent border-2 mx-auto">
                    <span
                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white font-bold text-5xl"
                    >
                        {{ $user->initials() }}
                    </span>
                </span>
            @endif
        </div>
        <div class="text-center py-5 space-y-1">
            <h1 class="font-bold text-3xl">{{ $user->name }}</h1>
            <div class="text-zinc-400">{{ "@" . $user->username }}</div>
            @if($user->description)
                <div class="text-sm whitespace-pre-line">{{ $user->description }}</div>
            @endif
        </div>
        <div class="space-y-5 mt-3">
            @foreach($user->links as $link)
                <div>
                    <a href="{{ $link->url }}" class="flex items-center justify-center text-center bg-linear-to-br from-accent to-fuchsia-800 rounded-full h-12 px-5 text-accent-foreground text-base font-medium hover:to-fuchsia-700">
                        <p class="truncate">
                            {{ $link->name }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
