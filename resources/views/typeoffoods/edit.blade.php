<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Redigera typ av mat</h1>
            <form method="post" action="/typeoffoods/{{ $typeoffood->id }}">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <div>
                        <label for="name">Namn:</label><br>
                        <input type="text" class="form-control" value="{{ $typeoffood->name }}" name="name"/>
                    </div>
                </div>
                @if(!$hasrecipe)
                    <div class="form-group mt-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="delete" name="delete"
                                   value="delete">
                            <label class="custom-control-label" for="delete">Ta bort ingrediensen. Inget recept använder
                                den.</label><br>
                        </div>
                    </div>@endif
                <button type="submit" class="btn-blue mt-3">Skicka</button>
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
