<x-headless-app>
    <style>
        DIV[data-lastpass-icon-root] {
            display: none !important; /* This disables LastPass */
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="ml-2" @if($errors->any()) x-data="{cookedopen: true}" @else x-data="{cookedopen: false}" @endif >
                <p><a class="btn-blue text-xs font-bold" href="/recipes">Receptsöksidan</a> <a class="btn-blue text-xs font-bold" href="/recipes/{{ $recipe->id }}/edit">Redigera receptet</a> <a class="btn-blue text-xs font-bold" href="/recipeload/{{ $recipe->id }}">Ladda upp fil</a>
                <h2 class="text-2xl my-4">{{ $recipe->name }}</h2>
                @if($recipe->cooked == 0 or $errors->any())
                    <div class="mb-4">
                    <hr>
                    <div x-on:click="cookedopen = ! cookedopen" class="text-blue-800" style="cursor: pointer;">Markera som lagad?</div>
                        <div class="bg-green-100" x-show="cookedopen">
                            <form method="post" action="/recipes/{{ $recipe->id }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-group pl-2">
                                    <div>
                                        <label for="latestcook">Senast lagad: </label><br>
                                        <input type="date" class="border rounded-lg mb-6"
                                               value="{{ old('latestcook') }}" name="latestcook">
                                    </div>
                                    <div class="mt-4">
                                        <label for="rating">Betyg: </label>
                                        <select name="rating" id="rating" class="border rounded-lg text-gray-700">
                                            <option value="">Välj:</option>
                                            <option value=1 {{ old('rating') == 1 ? 'selected': ''}}>1</option>
                                            <option value=2 {{ old('rating') == 2 ? 'selected': ''}}>2</option>
                                            <option value=3 {{ old('rating') == 3 ? 'selected': ''}}>3</option>
                                            <option value=4 {{ old('rating') == 4 ? 'selected': ''}}>4</option>
                                            <option value=5 {{ old('rating') == 5 ? 'selected': ''}}>5</option>
                                            <option value=6 {{ old('rating') == 6 ? 'selected': ''}}>6</option>
                                            <option value=7 {{ old('rating') == 7 ? 'selected': ''}}>7</option>
                                            <option value=8 {{ old('rating') == 8 ? 'selected': ''}}>8</option>
                                            <option value=9 {{ old('rating') == 9 ? 'selected': ''}}>9</option>
                                            <option value=10 {{ old('rating') == 10 ? 'selected': ''}}>10</option>
                                        </select>
                                        <div class="mt-4">
                                            <label for="judgement">Omdöme, vilka som bjudits...</label><br>
                                            <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                                                      id="whole_text" name="judgement">{{ old('judgement') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="markingcooked" name="markingcooked">
                                <button type="submit" class="btn-blue mt-6 ml-2 mb-2">Spara</button>
                            </form>
                            @if ($errors->any())
                                <div class="text-red-600 mt-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><b>{{ $error }}</b></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    <hr>
                    </div>
                @endif
                @if($recipe->ingredients()->first() != null)
                    <p><strong>Huvudingrediens(er): </strong>@foreach($recipe->ingredients()->get() as $ingredient) {{ $ingredient->name }}&nbsp;@endforeach</p>
                @endif
                @if($recipe->typeoffood_id != null)
                    <p><strong>Typ av mat: </strong> {{ $typeoffood->name }}</p>
                @endif
                @if($recipe->spice != null)
                    <p><strong>Specialingrediens (krydda): </strong> {{ $recipe->spice }}</p>
                @endif
                @if($recipe->c_time != null)
                    <p><strong>Tillagningstid: </strong> {{ $recipe->c_time }}</p>
                @endif
                @if($recipe->comment != null)
                    <p><strong>Kommentar: </strong> {{ $recipe->comment }}</p>
                @endif
                @if($recipe->printed_source != null)
                    <p><strong>Tryckt källa: </strong> {{ $recipe->printed_source }}</p>
                @endif
                @if($recipe->url != null)
                    <p><strong>Länk till receptet: </strong> <a class="text-blue-600 hover:underline" href="{{ $recipe->url }}" target="_blank">{{ $recipe->url }}</a></p>
                @endif
                @if($file != null)
                    <p><strong>Länk till fil: </strong> <a class="text-blue-600 hover:underline" href="/storage/files/{{ $file->filename }}" target="_blank">{{ $file->filename }}</a></p>
                @endif
                @if($recipe->whole_text != null)
                    <p><strong>Hela receptet: </strong> {!! nl2br(e($recipe->whole_text)) !!}</p>
                @endif
                @if($recipe->cooked)
                    <div class="bg-green-100 mt-4" >
                        <p><strong>Senast lagad: </strong> {{ $recipe->latestcook }}</p>
                        @if($recipe->rating)
                            <p><strong>Betyg: </strong> {{ $recipe->rating }}</p>
                            @endif
                        @if($recipe->judgement)
                            <p><strong>Omdöme: </strong> {{ $recipe->judgement }}</p>
                        @endif
                    </div>
                    @endif

            </div>
        </div>
    </div>
</x-headless-app>
