<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-3">Skapa ett minne</h1>
            <form method="post" action="/memories">
                @csrf
                <div class="pl-2">
                    <div class="form-group">
                        <label for="title">Titel:</label><br>
                        <input type="text"
                               class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                               value="{{ old('title') }}" name="title"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Beskrivning:</label><br>
                        <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                                  id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="source">Källa:</label><br>
                        <input
                            class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                            type="text" class="form-control" value="{{ old('source') }}" name="source"/>
                    </div>
                    <div class="form-group">
                        <label for="link">Länk:</label><br>
                        <input
                            class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                            type="text" class="form-control" value="{{ old('link') }}" name="link"/>
                    </div>
                    <div class="form-group">
                        Tags:<br>
                        <select multiple name="tags[]">
                            @if($tags)
                                @foreach($tags as $t)
                                    <option value="{{ $t['id'] }}">{{ $t['name'] }}</option>
                                @endforeach
                            @endif
                        </select><br>
                        <div class="form-group row">
                            <div class="col-xs-2 mt-4" x-data="{ newtaginput:false }">
                                Skapa och använd <a class="text-blue-700 hover:underline" href="#tags" x-on:click="newtaginput = !newtaginput">nya taggar:</a><br>
                                <div  id=tags x-show="newtaginput">
                                    <input type="text"
                                           class="max-w-sm w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                           value="{{ old('newtag1') }}" name="newtag1"/><br>
                                    <input type="text"
                                           class="max-w-sm w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                                           value="{{ old('newtag2') }}" name="newtag2"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">Viktighetsgrad:</div>
                    <div class="radio">
                        <label><input type="radio" name="importance"
                                      value="1" {{ (old('importance') === '1') ? 'checked' : '' }}> 1 &nbsp; </label>
                        <label> <input type="radio" name="importance"
                                       value="2" {{ (old('importance') === '2' || old('importance') === null) ? 'checked' : '' }}>
                            2 &nbsp; </label>
                        <label><input type="radio" name="importance"
                                      value="3" {{ (old('importance') === '3') ? 'checked' : '' }}> 3 &nbsp;</label>
                    </div>
                    <button type="submit" class="btn-blue mt-4">Skapa</button>
            </form>
        </div>
        <div>
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
    </div>
</x-headless-app>
