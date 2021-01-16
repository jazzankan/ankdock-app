<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 bg-green-100">
                    <h4><a class="text-blue-600 text-xl font-bold hover:text-purple-600 hover:underline" href="/memories">Minnen</a></h4>
                    <hr class="mt-4">
                    <h5 class="text-lg font-semibold">Projekt</h5>
                    <p><a href="/projects">Mina projekt</a></p>
                    <p><a href="/todos">Ofärdiga arbetsuppgifter</a></p>
                    <hr>
                    <h5>Blogg</h5>
                    <p><a href="/blog">Publik blogg</a></p>
                    <p><a href="/articles">Blogginlägg</a> - skapa och redigera</p>
                    <p><a href="/comments">Nya bloggkommentarer</a></p>
                    <p><a href="/categories">Bloggkategorier</a> - skapa och redigera</p>
                    <p><a href="/about">Om Ankhemmet</a> - lite info för bloggbesökare</p>

                    <hr>
                    Du är inloggad!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
