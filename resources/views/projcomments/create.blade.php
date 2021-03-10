<x-headless-app>
    <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
        <h1>Kommentera projektet "{{ $project->title }}"</h1>
        <form method="post" action="{{ route('projcomments.store') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-8">
                    <label for="name">Jag vill bara säga:</label>
                    <input type="text" class="form-control" value="{{ old('body') }}" name="body"/>
                    <input type="hidden" class="form-control" value="{{ $project->id }}" name="project_id"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Skapa</button>
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
</x-headless-app>
