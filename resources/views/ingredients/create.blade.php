<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Skapa ny ingrediens - råvara</h1>
            <form method="post" action="{{ route('ingredients.store') }}">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="name">Namn:</label><br>
                        <input type="text" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('name') }}" name="name"/>
                    </div>
                </div>
                <div class="mt-4">Kategori av råvara:</div>
                <div class="radio mb-6">
                    <label><input type="radio" name="category"
                                  value="meat" {{ (old('category') === 'meat') ? 'checked' : '' }}> Kött &nbsp; </label>
                    <label> <input type="radio" name="category"
                                   value="fish" {{ (old('category') === 'fish') ? 'checked' : '' }}>
                        Fisk &nbsp; </label>
                    <label><input type="radio" name="category"
                                  value="veg" {{ (old('category') === 'veg') ? 'checked' : '' }}> Vegetarisk (övrig) &nbsp;</label>
                </div>
                <button type="submit" class="btn-blue">Skapa</button>
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
</x-headless-app>
