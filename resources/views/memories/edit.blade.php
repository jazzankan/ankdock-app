<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="ml-2">
                <form method="post" action="/memories/{{ $memory->id  }}">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="form-group">
                        <label for="title">Titel:</label><br>
                        <input type="text" class="max-w-lg w-full mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $memory->title }}" name="title"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Beskrivning:</label><br>
                        <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" id="description" name="description">{{ $memory->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="source">Källa:</label><br>
                        <input type="text" class="max-w-lg w-full mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $memory->source }}" name="source"/>
                    </div>
                    <div class="form-group">
                        <label for="link">Länk:</label><br>
                        <input type="text" class="max-w-lg w-full mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $memory->link }}" name="link"/>
                    </div>
                    <div class="form-group">
                        Tags:<br>
                        <select multiple name="tags[]">
                            @foreach($tags as $t)
                                @if($seltags->contains('id', $t['id']))
                                    <option value ="{{ $t['id'] }}" selected>{{ $t['name'] }}</option>
                                @else
                                    <option value ="{{ $t['id'] }}">{{ $t['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="mt-4" x-data="{ newtaginput:false }">
                            Skapa och använd <a class="text-blue-700 hover:underline" href="#" x-on:click="newtaginput = !newtaginput">nya taggar:</a><br>
                            <div x-show="newtaginput">
                                <input type="text" class="form-control" value="{{ old('newtag1') }}" name="newtag1"/><br>
                                <input type="text" class="form-control" value="{{ old('newtag2') }}" name="newtag2"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">Viktighetsgrad:</div>
                    <div class="radio">
                        <label><input type="radio" name="importance" value="1"  {{ ($memory->importance === 1) ? 'checked' : '' }}> 1 </label>
                        <label> <input type="radio" name="importance" value="2" {{ ($memory->importance === 2  ) ? 'checked' : '' }}> 2 </label>
                        <label><input type="radio" name="importance" value="3"  {{ ($memory->importance === 3) ? 'checked' : '' }}> 3 </label>
                    </div>
                    <div class="form-group">
                        <div class="mt-4">
                            <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                            <label class="custom-control-label" for="delete">Ta bort minnet for gott!</label>
                        </div>
                    </div>
                    <button type="submit" class="btn-blue mt-4">Uppdatera</button>
                </form>
            </div>
            @if ($errors->any())
                <div class="text-red-600">
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
