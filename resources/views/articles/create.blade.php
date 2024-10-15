 <x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Skapa ett blogginlägg</h1>
            <form method="post" action="{{ route('articles.store') }}">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="heading">Rubrik:</label><br>
                        <input type="text"
                               class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500"
                               value="{{ old('heading') }}" name="heading"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body">Brödtext:</label><br>
                    <textarea class="form-control" id="body" name="body">{!! old('body') !!}</textarea>
                </div>
                <div class="form-group mt-3">
                    Kategorier:<br>
                    <select name="category_id">
                        <option value="" selected>Välj:</option>
                        @foreach($categories as $c)
                            <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="radio mt-3">
                    <label><input type="radio" name="published" value="no" checked="checked"> Opublicerad</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="published" value="yes"> Publicerad</label>
                </div>
                <div>
                </div>
                <button type="submit" class="btn-blue mt-3">Skapa</button>
            </form>
            <div>
                <p>
                @if ($errors->any())
                    <div class=" mt-3 text-red-600">
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
    </div>
</x-headless-app>
 <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
 <script>
     // Initialize CKEditor
     ClassicEditor
         .create(document.querySelector('textarea'))
         .then(editor => {
             console.log('Editor was initialized', editor);
         })
         .catch(error => {
             console.error('Error during initialization of the editor', error);
         });
 </script>
