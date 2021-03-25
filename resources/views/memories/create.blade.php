<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-3">Skapa ett minne</h1>
            <form method="post" action="/memories/create">
                @csrf
                <div class="form-group">
                    <label for="title">Titel:</label>
                    <input type="text" class="form-control" value="{{ old('title') }}" name="title"/>
                </div>
                <div class="form-group">
                    <label for="description">Beskrivning:</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="source">Källa:</label>
                    <input type="text" class="form-control" value="{{ old('source') }}" name="source"/>
                </div>
                <div class="form-group">
                    <label for="link">Länk:</label>
                    <input type="text" class="form-control" value="{{ old('link') }}" name="link"/>
                </div>
                <div class="form-group">
                    Tags:<br>
                    <select multiple name="tags[]">
                        @if($tags)
                            @foreach($tags as $t)
                                <option value ="{{ $t['id'] }}">{{ $t['name'] }}</option>
                            @endforeach
                        @endif
                    </select><br>
                    <div class="form-group row">
                        <div class="col-xs-2">
                            Skapa och använd <a href="#" v-on:click="newtaginput = true">nya taggar:</a><br>
                            <div v-show="newtaginput">
                                <input type="text" class="form-control" value="{{ old('newtag1') }}" name="newtag1"/><br>
                                <input type="text" class="form-control" value="{{ old('newtag2') }}" name="newtag2"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div>Viktighetsgrad:</div>
                <div class="radio">
                    <label><input type="radio" name="importance" value="1" {{ (old('importance') === '1') ? 'checked' : '' }}> 1 &nbsp; </label>
                    <label> <input type="radio" name="importance" value="2" {{ (old('importance') === '2' || old('importance') === null) ? 'checked' : '' }}> 2 &nbsp; </label>
                    <label><input type="radio" name="importance" value="3" {{ (old('importance') === '3') ? 'checked' : '' }}> 3 &nbsp;</label>
                </div>
                <button type="submit" class="btn btn-primary">Skapa</button>
            </form>
        </div>
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
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
