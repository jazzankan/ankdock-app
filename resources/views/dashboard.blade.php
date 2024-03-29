<x-app-layout>
    <x-slot name="header">
        <img class="inline rounded" src="https://webbsallad.se/ankfiles/redduck100.png"><span class="ml-4 text-3xl text-red-900">Ankhemmet</span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-lg bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-green-100">
                    <h4><a class="text-blue-600 text-xl font-bold hover:text-purple-600 hover:underline" href="/memories">Minnen</a></h4>
                    <hr class="my-3 hrdash">
                    <h5 class="text-lg font-semibold">Projekt</h5>
                    <p><a class="dashlink" href="/projects">Mina projekt</a></p>
                    <p><a class="dashlink" href="/todos">Ofärdiga arbetsuppgifter</a></p>
                    <hr class="my-3 hrdash">
                    <h4><a class="text-blue-600 text-xl font-bold hover:text-purple-600 hover:underline" href="/recipes">Recept</a></h4>
                    <hr class="my-3 hrdash">
                    <h5 class="text-lg font-semibold">Blogg</h5>
                    <p><a class="dashlink" href="/blog">Publik blogg</a> - bara Anders kan redigera.</p>
                    @if(Auth::user()->id === $anders->id)
                    <p><a class="dashlink" href="/articles">Blogginlägg</a> - skapa och redigera</p>
                    <p><a class="dashlink" href="/comments">Nya bloggkommentarer</a></p>
                    <p><a class="dashlink" href="/categories">Bloggkategorier</a> - skapa och redigera</p>
                    <p><a class="dashlink" href="/about">Om Ankhemmet</a> - länk finns från publika sidan</p>
                    <hr class="my-3">
                    <p>Externa visningar: <b>{{ $visitingnumber }}</b>, sedan 2022-05-02</p>
                    @endif
                    <hr class="my-3">
                    <p class="text-sm">Du är inloggad!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
