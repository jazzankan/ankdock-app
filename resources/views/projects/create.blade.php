<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-2">Skapa nytt projekt</h1>
        <div>
            <form method="post" action="{{ route('projects.store') }}">
                @csrf
                <div class="pl-2">
                        <label for="title">Namn:</label><br>
                        <input type="text" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('title') }}" name="title"/>
                <div class="form-group">
                    <label for="description">Beskrivning:</label><br>
                    <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"" id="description" name="description">{!! old('description') !!}</textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="deadline">Deadline om det finns:</label><br>
                        <input type="date" class="border rounded-lg mb-6" value="{{ old('deadline') != null ? old('deadline') : ''}}" name="date">
                    </div>
                </div>
                <div class="mb-6">
                    <label><input type="radio" name="must" value="y" {{ (old('must') === 'n') ? '' : 'checked' }}> Plikt</label>
                    <label><input type="radio" name="must" {{ (old('must') === 'n') ? 'checked' : '' }} value="n"> Hobby eller nöje</label>
                </div>
                <div>
                    Dela projektet med:<br>
                    <select class="border rounded-lg mb-6" multiple name="selshare[]">
                        @foreach($usersminusme as $s)
                            <option value ="{{ $s->name }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-blue">Skapa</button>
                </div>
            </form>
        </div>
    </div>
</x-headless-app>
