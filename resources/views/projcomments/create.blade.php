<x-headless-app>
    <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl my-4">Kommentera projektet "{{ $project->title }}"</h2>
        <form method="post" action="{{ route('projcomments.store') }}">
            @csrf
            <div>
                    <label for="name">Jag vill bara säga: </label>
                    <input type="text" class="border rounded-lg" autofocus value="{{ old('body') }}" name="body"/>
                    <input type="hidden" value="{{ $project->id }}" name="project_id"/>
            </div>
            <button type="submit" class="mt-4 btn-blue">Skapa</button>
        </form>
    <div>
        <p>
        @if ($errors->any())
            <div class="text-red-600 mt-4">
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
