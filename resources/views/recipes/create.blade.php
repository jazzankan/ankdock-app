<x-headless-app>
    <style>
        DIV[data-lastpass-icon-root] {
            display: none !important; /* This disables LastPass */
        }
    </style>
    <div class="py-12 pl-2">
        <div x-data="{ commentopen: false, printopen: false, urlopen: false, fileopen: false, wholeopen: false }">
            <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
                <h1 class="text-3xl mb-3">Lägg in nytt recept</h1>
                <form method="post" action="{{ route('recipes.store') }}">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label for="name">Namn:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ old('name') }}" name="name"/>
                        </div>
                        <div>
                            <label for="ingredients">Huvudråvaror:</label>
                            <select multiple name="ingredients[]" id="ingredients"
                                    class="border rounded-lg text-gray-700">
                                <option value="">Välj:</option>
                                @foreach($ingredients as $i)
                                    <option value="{{ $i->id }}" @if(old('ingredients')) {{ in_array($i->id, old('ingredients')) ? 'selected': '' }}@endif>{{ $i->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="typeoffoods_id">Typ av mat:</label>
                            <select name="typeoffoods_id" id="typeoffoods_id" class="border rounded-lg text-gray-700">
                                <option value="">Välj:</option>
                                @foreach($typeoffoods as $t)
                                    <option value="{{ $t->id }}" {{ old('typeoffoods_id') == $t->id ? 'selected': ''}}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="spice">Specialingrediens (krydda):</label><br>
                            <input type="text"
                                   class="max-w-lg w-half mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ old('spice') }}" name="spice"/>
                        </div>
                        <div>
                            <label for="c_time">Tillagningstid:</label><br>
                            <input type="text"
                                   class="max-w-lg w-half mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ old('c_time') }}" name="c_time"/>
                        </div>
                    </div>
                    <div class="radio mb-6">
                        <label><input type="radio" name="eating_order"
                                      value="starter" {{ (old('eating_order') === 'starter') ? 'checked' : '' }}>
                            Förrätt </label>
                        <label> <input type="radio" class="ml-2" name="eating_order"
                                       value="main" {{ (old('eating_order') === 'main') || (old('eating_order') == '') ? 'checked' : '' }}>
                            Huvudrätt</label>
                        <label><input type="radio" class="ml-2" name="eating_order"
                                      value="dessert" {{ (old('eating_order') === 'dessert') ? 'checked' : '' }}>
                            Efterrätt</label>
                        <label><input type="radio" class="ml-2" name="eating_order"
                                      value="baking" {{ (old('eating_order') === 'baking') ? 'checked' : '' }}>
                            Bakning</label>
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
