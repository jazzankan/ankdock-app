<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Recept</h1>
            <p><a class="btn-blue text-xs font-bold" href="/recipes/create" class="btn btn-primary btn-sm">Nytt recept</a>
                <a class="btn-blue text-xs font-bold" href="/ingredients" class="btn btn-primary btn-sm">Huvudingredienser</a>
                <a class="btn-blue text-xs font-bold" href="/typeoffoods" class="btn btn-primary btn-sm">Typ av mat</a>
            </p>
            <p class="text-red-800 mt-4"><strong>Sidan under utveckling! Just nu bara en alfabetisk lista.</strong></p>
            <hr class="mt-4">
            <ul class="mt-4">
                @foreach ($recipes as $rec)
                    <li class="todo pl-2 py-2.5"><h4><a class="dashlink" href="/recipes/{{ $rec->id }}">{{ $rec->name }}
                                <span class="text-xs text-green-700">
                                    @if($rec->latestcook)<br>Lagad: {{ $rec->latestcook }} @endif</span></a></h4>
                @endforeach
            </ul>
        </div>
    </div>
</x-headless-app>
