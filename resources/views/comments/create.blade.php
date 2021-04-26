<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl">Hej! Tack för att du vill kommentera inlägget "<span
                        class="text-green-600 font-bold">{{ $article->heading }}</span>"</h2>
            <p class="mt-3">Ankhemmet är ett milt <b>a</b>socialt medium. Följande gäller:</p>
            <ul class="list-disc my-4">
                <li>Du måste ange en giltig e-postadress!</li>
                <li>Din e-postadress publiceras <strong>aldrig</strong> om du inte själv skriver in den i själva
                    kommentarstexten. Den lämnas inte vidare till någon.
                </li>
                <li>Du kan välja om du bara vill höra av dig eller om du vill ha din kommentar publicerad.</li>
                <li>Alla kommentarer granskas innan de eventuellt publiceras. Det kan ta lite tid!</li>
                <li>Om du vill publicera din kommentar går du med på att namn och e-postadress lagras i Ankhemmets
                    databas.
                </li>
            </ul>
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <p><label for="name">Namn - gärna ditt riktiga:</label><br>
                            <input type="text" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('name') }}" name="name" required/></p>
                        <p><label for="email">E-post:</label><br>
                            <input type="email" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('email') }}" name="email" required/>
                        </p>
                        <div class="form-check">
                            <p><input type="checkbox" class="form-check-input" name="wishpublic"
                                      value="yes" {{ (old('wishpublic') === 'yes') ? 'checked' : '' }}>
                                <label class="form-check-label" for="wishpublic">Jag vill att min kommentar publiceras i
                                    bloggen.</label></p>
                        </div>
                        <div class="form-group mt-3">
                            <label for="body">Min text:</label><br>
                            <textarea class="mb-6 w-3/5 px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" id="body" name="body" required>{{ old('body') }}</textarea>
                        </div>
                        <input type="hidden" value="{{ $article->id }}" name="article_id"/>
                    </div>
                </div>
                <p>
                    <button type="submit" class="btn-blue">Skicka</button>
                </p>
            </form>
            <div class="mt-3" x-data="{ isOpen: false }">
                <p x-on:click="isOpen = !isOpen"><a class="text-blue-600 hover:underline" href="#">Visa inlägget du vill kommentera här (ifall du behöver kolla
                        något):</a></p>
                <div x-show="isOpen">{!! $article->body !!}</div>
            </div>
            <div>
                <p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    </p>
            </div>
        </div>
</x-headless-app>
