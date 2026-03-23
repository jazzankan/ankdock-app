<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Sök recept</h1>
            <p><a class="btn-blue text-xs font-bold" href="/recipes/create">Nytt recept</a>
                <a class="btn-blue text-xs font-bold" href="/ingredients">Huvudingredienser</a>
                <a class="btn-blue text-xs font-bold" href="/typeoffoods">Typ av mat</a>
            </p>
            @if(count($latestrecipes) > 0)
            <livewire:recipesearch />
            <hr class="mt-4">
            <p class="bg-green-100"><strong>Senast visade:<br></strong><a class="dashlink" href="/recipes/{{ $latestviewed->id }}">{{ $latestviewed->name }}</a>@if($latestviewed->latestcook), <span class="text-xs text-green-700">lagad: {{ $latestviewed->latestcook }}</span>@endif</p>
            <p class="mt-6"><strong>Senaste fem inlagda:</strong></p>
            <ul>
                @foreach ($latestrecipes as $rec)
                    <li class="todo pl-2 py-2.5"><h4><a class="dashlink" href="/recipes/{{ $rec->id }}">{{ $rec->name }}</a>
                                <span class="text-xs text-green-700">
                                    @if($rec->latestcook)<br>Lagad: {{ $rec->latestcook }} @endif</span></h4>
                @endforeach
            </ul>
            @else
                <h1 class="text-2xl mt-6">Det finns inga recept ännu!</h1>
            @endif
        </div>
    </div>
</x-headless-app>
