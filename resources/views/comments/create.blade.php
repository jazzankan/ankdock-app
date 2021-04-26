<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h3>Hej! Tack för att du vill kommentera inlägget <strong>"<span class="articletitle">{{ $article->heading }}</span>"</strong></h3>
            <p>Ankhemmet är ett milt <b>a</b>socialt medium. Följande gäller:</p>
            <ul>
                <li>Du måste ange en giltig e-postadress!</li>
                <li>Din e-postadress publiceras <strong>aldrig</strong> om du inte själv skriver in den i själva kommentarstexten. Den lämnas inte vidare till någon.</li>
                <li>Du kan välja om du bara vill höra av dig eller om du vill ha din kommentar publicerad.</li>
                <li>Alla kommentarer granskas innan de eventuellt publiceras. Det kan ta lite tid!</li>
                <li>Om du vill publicera din kommentar går du med på att namn och e-postadress lagras i Ankhemmets databas.</li>
            </ul>
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <p><label for="name">Namn - gärna ditt riktiga:</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required/></p>
                        <p><label for="email">E-post:</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" required/></p>
                        <div class="form-check">
                            <p><input type="checkbox" class="form-check-input" name="wishpublic" value="yes" {{ (old('wishpublic') === 'yes') ? 'checked' : '' }}>
                                <label class="form-check-label" for="wishpublic">Jag vill att min kommentar publiceras i bloggen.</label></p>
                        </div>
                        <div class="form-group">
                            <label for="body">Min text:</label>
                            <textarea class="form-control" id="body" name="body" required>{{ old('body') }}</textarea>
                        </div>
                        <input type="hidden" value="{{ $article->id }}" name="article_id"/>
                    </div>
                </div>
                <p><button type="submit" class="btn btn-primary">Skicka</button></p>
            </form>
            <p v-on:click="showart()"><a href="#">Visa inlägget du vill kommentera här (ifall du behöver kolla något):</a></p>
            <div v-if="artshow">{!! $article->body !!}</div>
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
