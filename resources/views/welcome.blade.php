<x-layouts.app>
    <div class="w-full max-w-3xl">
        <div class="prose prose-slate dark:prose-invert max-w-none">
            <h1>Linkkilista.fi</h1>
            <p>Luo oma linkkilistasi <strong>ilmaiseksi</strong>. Linkkilista on kokoelma valitsemiasi linkkejä. Voit sitten jakaa linkkilistasi linkin vapaasti muille.</p>

            <div class="not-prose flex gap-4">
                <flux:button href="{{ route('register') }}" variant="primary">Luo tunnus</flux:button>
                <flux:button href="{{ route('login') }}">Kirjaudu sisään</flux:button>
            </div>

            <h2>Usein Kysyttyjä Kysymyksiä</h2>
            <p>Listasimme alas usein kysyttyjä kysymyksiä linkkilistasta.</p>
        </div>
    </div>
    <div>
        @php
        $questions = [
            [
                'question' => 'Tarvitsenko tunnukset?',
                'answer' => '<p>Tarvitset tunnukset, jos haluat luoda oman linkkilistan. Tunnuksia ei tarvitse linkkilistan katseluun.</p>',
            ],
            [
                'question' => 'Maksaako käyttäminen?',
                'answer' => '<p>Ei maksa mitään.</p>',
            ],
            [
                'question' => 'Seurataanko minua?',
                'answer' => '<p>Sivustolla on käytössä itse ylläpidetty <a href="https://plausible.io/">Plausible Analytics</a> sovellus, jolla seuraamme sivujen kävijämääriä.</p>',
            ],
            [
                'question' => 'Onko linkkilistassa mainoksia?',
                'answer' => '<p>Ei ole. Emme mainosta käyttäjien linkkilistoissa.</p>',
            ],
            [
                'question' => 'Löysin bugin tai minulla on kehitysehdoitus, minne voin lähettää sen?',
                'answer' => '<p>Voit lähettää meille bugeja tai kehitysehdotuksia sähköpostilla <a href="mailto:moi@linkkilista.fi">moi@linkkilista.fi</a> tai <a href="https://github.com/MarkoKaartinen/linkkilista.fi">GitHubin kautta</a>.</p>',
            ],
            [
                'question' => 'Miten saa yhteyttä?',
                'answer' => '<p>Yhteyttä saa sähköpostiosoitteen <a href="mailto:moi@linkkilista.fi">moi@linkkilista.fi</a> kautta.</p>',
            ],
        ];
        @endphp

        <div class="md:col-span-3">

            <div class="pt-6">
                @foreach($questions as $question)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-12 border-t border-slate-700 py-6">
                        <div class="">
                            <h3 class="font-bold dark:text-slate-100">{{ $question['question'] }}</h3>
                        </div>
                        <div class="md:col-span-3">
                            <div class="prose prose-sm prose-slate dark:prose-invert max-w-none">
                                {!! $question['answer'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
