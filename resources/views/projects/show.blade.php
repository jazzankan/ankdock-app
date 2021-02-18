<x-headless-app>
    <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
        <div class="my-4 pl-2">
            <a href="/projects/" class="btn-blue text-xs font-bold">Projektlistan</a> <a class="btn btn-blue text-xs font-bold"href="/projects/{{ $project->id }}/edit">Redigera projektet</a> <a href="/upload/{{ $project->id }}" class="btn-blue text-xs font-bold">Ladda upp fil</a> <a class="btn-gray text-xs font-bold"href="/projcomments/create?projid={{ $project->id }}">Ny kommentar</a>
        </div>
        <div class="pl-2">
    <h1 class="text-3xl mb-3">{{ $project->title }}</h1>
        <p class="font-bold">Beskrivning:</p>
        {!! $project->description !!}
            @if($project->deadline)
            <p class="mt-3"><span class="font-bold">Deadline:</span> {{ $project->deadline }}</p>
                @endif
        </div>
        <hr class="my-4">
        <h2 class="text-2xl mb-3">Arbetsuppgifter</h2>
        <a href="/todos/create/{{ $project->id }}" class="btn-blue text-xs font-bold">Skapa arbetsuppgift</a>
    </div>
</x-headless-app>
