<div class="mt-4 mb-4">
    <div class="radio mb-2">
        <label><input wire:click="dish('starter')" type="radio" name="eating_order"
                      value="starter">
            Förrätt </label>
        <label> <input wire:click="dish('main')" type="radio" class="ml-2" name="eating_order"
                       value="main" checked>
            Huvudrätt</label>
        <label><input wire:click="dish('dessert')" type="radio" class="ml-2" name="eating_order"
                      value="dessert">
            Efterrätt</label>
        <label><input wire:click="dish('baking')" type="radio" class="ml-2" name="eating_order"
                      value="baking">
            Bakning</label>
    </div>
    <input type="text"
           autocomplete="off"
           onclick="this.value=''"
           class="max-w-lg w-full mt-2 mb-0 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
           value="" name="artistselect" placeholder="Sök recept..." wire:model.live="query" wire:click="emptyquery"/><br>
    @if(strlen($query)>2)
        <p class="py-0 mt-6"><strong>Träffar:</strong></p>
        <ul>
            @if(count($recipes) > 0)
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
        @if($showallcat)
        <div>
            <p wire:click="allcat" class="mt-4 text-xs font-bold dashlink" style="cursor:pointer">Alla i vald kategori</p>
        </div>
        @endif
        <div>
            <p wire:click="random" class="mt-4 text-xs font-bold dashlink" style="cursor:pointer">Slumpa fram ett recept</p>
            <div wire:model="random_recipe">
                @if($random_recipe != null)
                    <p class="bg-red-100"><strong>Slumpad rätt:<br></strong><a class="dashlink" href="/recipes/{{ $random_recipe->id }}">{{ $random_recipe->name }}</a>@if($random_recipe->latestcook), <span class="text-xs text-green-700">lagad: {{ $random_recipe->latestcook }}</span>@endif</p>
                @endif
            </div>
        </div>
</div>
