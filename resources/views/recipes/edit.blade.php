<x-headless-app>
    <style>
        DIV[data-lastpass-icon-root] {
            display: none !important; /* This disables LastPass */
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div class="py-12 pl-2">
        <div x-data="{ commentopen: false, printopen: false, urlopen: false, fileopen: false, wholeopen: false }">
            <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
                <h1 class="text-3xl mb-3">Redigera recept:</h1>
                <form method="post" action="/recipes/{{ $recipe->id }}">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <div>
                            <label for="name">Namn:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ $recipe->name }}" name="name"/>
                        </div>
                        <div>
                            <label for="ingredients">Huvudråvaror:</label>
                            <select multiple name="ingredients[]" id="ingredients"
                                    class="border rounded-lg text-gray-700">
                                <option value="">Välj:</option>
                                @foreach($ingredients as $i)
                                    <option value="{{ $i->id }}" {{ $i->recipes()->where('recipe_id', $recipe->id)->first() ? 'selected': '' }}>{{ $i->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="typeoffood_id">Typ av mat:</label>
                            <select name="typeoffood_id" id="typeoffood_id" class="border rounded-lg text-gray-700">
                                <option value="">Välj:</option>
                                @foreach($typeoffoods as $t)
                                    <option value="{{ $t->id }}" {{ $t->id == $recipe->typeoffood_id ? 'selected': ''}}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="spice">Specialingrediens (krydda):</label><br>
                            <input type="text"
                                   class="max-w-lg w-half mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ $recipe->spice }}" name="spice"/>
                        </div>
                        <div>
                            <label for="c_time">Tillagningstid:</label><br>
                            <input type="text"
                                   class="max-w-lg w-half mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ $recipe->c_time }}" name="c_time"/>
                        </div>
                    </div>
                    <div class="radio mb-6">
                        <label><input type="radio" name="eating_order"
                                      value="starter" {{ $recipe->eating_order === 'starter' ? 'checked' : '' }}>
                            Förrätt </label>
                        <label> <input type="radio" class="ml-2" name="eating_order"
                                       value="main" {{ $recipe->eating_order === 'main' ? 'checked' : '' }}>
                            Huvudrätt</label>
                        <label><input type="radio" class="ml-2" name="eating_order"
                                      value="dessert" {{ $recipe->eating_order === 'dessert' ? 'checked' : '' }}>
                            Efterrätt</label>
                    </div>
                    <div>
                        <p x-on:click="commentopen = ! commentopen" class="text-blue-800" style="cursor: pointer"><b>Lägg
                                till kommentar</b></p>
                        <div x-show="commentopen">
                            <label for="name">Kommentar:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ old('comment') }}" name="comment"/>
                        </div>
                    </div>
                    <p class="font-bold mt-4">Välj minst ett sätt att hitta hela receptet:</p>
                    <p class="text-blue-800" style="cursor: pointer" x-on:click="printopen = ! printopen"><b>Ange tryckt
                            källa</b></p>
                    <div x-show="printopen" class="mt-4">
                        <label for="printed_source">Tryckt i:</label><br>
                        <input type="text"
                               class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                               value="{{ old('printed_source') }}" name="printed_source"/>
                    </div>
                    <div>
                        <a class="text-blue-800" href="/recipeupload" target="_blank"><b>Ladda upp fil </b><span class="text-sm">(Öppnas i ny flik)</span></a>
                    </div>
                    <div>
                        <p class="text-blue-800" style="cursor: pointer" x-on:click="urlopen = ! urlopen"><b>Länka till
                                webbsida</b></p>
                        <div x-show="urlopen">
                            <label for="url">URL:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ old('url') }}" name="url"/>
                        </div>
                    </div>
                    <p class="text-blue-800" style="cursor: pointer" x-on:click="wholeopen = ! wholeopen"><b>Hela
                            texten</b></p>
                    <div x-show="wholeopen" class="mt-4">
                        <label for="whole_text">Klistra in eller skriv text:</label><br>
                        <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                                  id="whole_text" name="whole_text">{{ old('whole_text') }}</textarea>
                    </div>
                    <button type="submit" class="btn-blue mt-6">Skicka</button>
                </form>
                @if ($errors->any())
                    <div class="text-red-600 mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-headless-app>
