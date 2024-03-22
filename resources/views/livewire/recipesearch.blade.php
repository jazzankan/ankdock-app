<div class="mb-8">
    <input type="text"
           autocomplete="off"
           onclick="this.value=''"
           class="max-w-lg w-full mt-2 mb-0 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
           value="" name="artistselect" placeholder="Sök recept..." wire:model.live="query" wire:click="emptyquery"/><br>
    @if(strlen($query)>2)
        <p class="py-0 mt-6"><strong>Träffar:</strong></p>
        <ul>
            @if(count($recipes)> 0)
                @foreach ($recipes as $rec)
                    <li class="todo pl-2 py-2.5"><h4><a class="dashlink" href="/recipes/{{ $rec->id }}">{{ $rec->name }}</a>
                            <span class="text-xs text-green-700">
                                    @if($rec->latestcook)<br>Lagad: {{ $rec->latestcook }} @endif</span></h4>
                @endforeach
            @else
                <li class="text-red-800 font-bold">Ingen träff!</li>
            @endif
                <hr>
                <hr class="mt-4">
            @endif
        </ul>
</div>
