<x-headless-app>
    <style>
        DIV[data-lastpass-icon-root] {
            display: none !important; /* This disables LastPass */
        }
    </style>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Lägg in nytt recept</h1>
            <form method="post" action="{{ route('recipes.store') }}">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="name">Namn:</label><br>
                        <input type="text" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('name') }}" name="name"/>
                    </div>
                    <div>
                        <label for="ingredients">Huvudråvara:</label>
                        <select name="ingredients" id="ingredients" class="border rounded-lg text-gray-700">
                            <option value="">Välj:</option>
                            @foreach($ingredients as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="typeoffoods">Typ av mat:</label>
                        <select name="typeoffoods" id="typeoffoods" class="border rounded-lg text-gray-700">
                            <option value="">Välj:</option>
                            @foreach($typeoffoods as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="spice">Specialingrediens (krydda):</label><br>
                        <input type="text" class="max-w-lg w-half mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('spice') }}" name="spice"/>
                    </div>
                    <div>
                        <label for="c_time">Tillagningstid:</label><br>
                        <input type="text" class="max-w-lg w-half mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('c_time') }}" name="c_time"/>
                    </div>
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
</x-headless-app>
