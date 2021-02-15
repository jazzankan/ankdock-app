<x-headless-app>
    <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
        <div class="my-4 pl-2">
            <a href="/projects/" class="btn-blue text-xs font-bold">Projektlistan</a> <a class="btn btn-blue text-xs font-bold"href="/projects/{{ $project->id }}/edit">Redigera projektet</a> <a href="/upload/{{ $project->id }}" class="btn-blue text-xs font-bold">Ladda upp fil</a> <a class="btn-gray text-xs font-bold"href="/projcomments/create?projid={{ $project->id }}">Ny kommentar</a>
        </div>
        <div class="pl-2">
    <h1 class="text-3xl mb-3">{{ $project->title }}</h1>
        <p class="font-bold">Beskrivning:</p>
        {!! $project->description !!}
        </div>
    </div>
</x-headless-app>
