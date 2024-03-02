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
                        <label for="name">Kommentar:</label><br>
                        <input type="text"
                               class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                               value="{{ $recipe->comment }}" name="comment"/>
                    </div>
                    <div class="mt-4">
                        <label for="printed_source">Tryckt i:</label><br>
                        <input type="text"
                               class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                               value="{{ $recipe->printed_source }}" name="printed_source"/>
                    </div>
                    <div>
                        <label for="url">URL:</label><br>
                        <input type="text"
                               class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                               value="{{ $recipe->url }}" name="url"/>
                    </div>
                    <div class="mt-4">
                        <label for="whole_text">Hela texten:</label><br>
                        <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                                  id="whole_text" name="whole_text">{{ $recipe->whole_text }}</textarea>
                    </div>
                    @if($file != null)
                        <p><strong>Länk till fil: </strong> <a class="text-blue-600 hover:underline" href="/storage/files/{{ $file->filename }}" target="_blank">{{ $file->filename }}</a></p>
                    @else
                        <p>Tillhörande fil saknas. Kan laddas upp från receptets sida.</p>
                    @endif
                    @if($recipe->cooked)
                        <div class="mt-4">
                            <label for="latestcook">Senast lagad:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ $recipe->latestcook }}" name="latestcook"/>
                        </div>
                        <div>
                            <label for="rating">Betyg:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ $recipe->rating }}" name="rating"/>
                        </div>
                        <div>
                            <label for="judgement">Omdöme:</label><br>
                            <input type="text"
                                   class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                   value="{{ $recipe->judgement }}" name="judgement"/>
                        </div>
                    @endif
                    <div class="mt-4">
                        <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                        <label class="custom-control-label" for="delete">Ta bort receptet helt!</label>
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
