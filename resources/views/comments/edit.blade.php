<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl">Behandla bloggkommentar</h1>
            <form method="post" action="/comments/{{ $comment->id }}">
                {{ method_field('PATCH') }}
                @csrf
                <div>
                    <div class="mt-4">
                        <label for="name">Text:</label><br>
                        <textarea type="text" class="mb-6 w-3/5 px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" value="{{ $comment->body }}"
                                  name="body">{{ $comment->body }}</textarea>
                    </div>
                </div>
                <p>Inskickad av <strong>{{ $comment->name }}</strong><br> {{ $comment->email }}</p>
                <p>Vill ha publicerad: @if($comment->wishpublic === 'yes')Ja @else Nej @endif</p>
                @if($comment->wishpublic ==='yes')
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="published" value="yes">
                            <label class="form-check-label" for="publish">Publicera</label>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="reviewed" value="yes" checked="checked">
                        <label class="form-check-label" for="publish">Granskad</label>
                    </div>
                </div>
                <button type="submit" class="btn-blue mt-3">Skicka</button>
            </form>
            <p> {{ $comment->belongart }}</p>
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
