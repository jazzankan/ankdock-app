<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Redigera artikeln <span class="projtitel">"{{ $article->heading }}"</span></h1>
            <form method="post" action="/articles/{{ $article->id }}">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <div>
                        <label for="heading">Rubrik:</label><br>
                        <input type="text" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $article->heading }}" name="heading"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body">Brödtext:</label>
                    <textarea class="form-control" id="body" name="body">{!! $article->body !!}</textarea>
                </div>
                <div class="form-group mt-3">
                    Kategorier:<br>
                    <select name="category_id">
                        @foreach($categories as $c)
                            @if($article->category_id === $c['id']))
                            <option value="{{ $c['id'] }}" selected>{{ $c['name'] }}</option>
                            @else
                                <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="radio mt-3">
                    <label><input type="radio" name="published"
                                  value="no" {{ ($article->published === 'no') ? 'checked' : '' }}> Opublicerad</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="published"
                                  {{ ($article->published === 'yes') ? 'checked' : '' }} value="yes"> Publicerad</label>
                </div>
                <div class="form-group mt-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="delete" name="delete" value="delete">
                        <label class="custom-control-label" for="delete">Ta bort inlägget för gott.</label>
                    </div>
                </div>
                <div>
                </div>
                <button type="submit" class="btn-blue mt-3">Skicka</button>
            </form>
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
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        function ckreplace() {
            CKEDITOR.replace('body');
        }

        window.onload = ckreplace;
    </script>
</x-headless-app>
