<x-app-layout>
    <x-slot name="header">
        <p><img class="inline rounded" src="https://webbsallad.se/ankfiles/redduck100.png">
            <span class="ml-4 text-3xl text-red-900">Kläckt från <a class="underline hover:text-blue-600" href="/about">Ankhemmet</a></span></p>
    </x-slot>
    <div class="py-12 pl-2 pr-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <p><a href="/blog" class="btn-blue">Visa alla blogginlägg</a></p>
            <h2 class="mt-6 text-2xl">{{ $article->heading  }}</h2>
            <p class="mt-3">{!! $article->body !!}</p>
            @if(count($article->comments) > 0)
                <p class="mt-4"><strong>Kommentarer:</strong></p>
            @foreach($article->comments as $com)
                @if($com->published === "yes")
                    <p class="mb-3"><span class="text-yellow-900">{{ $com->body }}</span><br><b>{{ $com->name }}</b></p>
                @endif
            @endforeach
            @endif
            <p class="mt-3">Publicerad: {{$article->updated_at->format('Y-m-d')}}</p>
            <p class="mt-3"><a class="text-blue-600 hover:underline" href="/comments/create?artid={{ $article->id }}">Återkoppla/Kommentera</a></p>
        </div>
    </div>
</x-app-layout>
