<x-headless-app>
    <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
        <div class="my-4 pl-2 break-normal">
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
        <div class="pl-2">
        <h2 class="text-2xl mb-3">Arbetsuppgifter</h2>
        <a href="/todos/create/{{ $project->id }}" class="btn-blue text-xs font-bold">Skapa arbetsuppgift</a>
        <div class="mt-4">
            @if($belongingtodos->isNotEmpty())
                <ul class="border border-gray-300 border-opacity-70">
                    <li class="pl-2"><h5 class="py-2 text-xl text-red-600">Ogjort</h5></li>
                    @foreach ($belongingtodos as $todo)
                        @if($todo->status === 'n')
                            <li class="pl-2 py-2.5"><a class="text-blue-700 hover:underline" href="/todos/{{ $todo->id }}/edit">{{ $todo->title }}</a><span class="float-right mr-4"> Deadline: <span @if($todo['deadline'] <= $today)class="text-red-600"@endif><b>{{ $todo->deadline }}</b></span>&nbsp;&nbsp;<span class=""><b>{{ $todo->priority }}</b></span>&nbsp;&nbsp<span class=""><b>{{$todo->assigned}}</b></span>&nbsp;&nbsp<span><button type='button' class='btn btn-link' data-toggle='modal' data-target='#detailsModal' @click="getDetail($event, '{{ $todo->details }}')"><span class="" v-if="'{{ $todo->details }}'">Detaljer</span></button></span></span></li>
                        @endif
                    @endforeach
                </ul>
                <ul class="mt-3 border border-gray-300 border-opacity-70">
                    <li class="pl-2"><h5 class="py-2 text-xl text-yellow-600">Pågående</h5></li>
                    @foreach ($belongingtodos as $todo)
                        @if($todo->status === 'o')
                            <li class="pl-2 py-2.5"><a class="todolink" href="/todos/{{ $todo->id }}/edit">{{ $todo->title }}</a><span class="todoline"><span class="deadline"> Deadline: <span @if($todo['deadline'] <= $today)class="redalert"@endif><b>{{ $todo->deadline }}</b></span>&nbsp;&nbsp;</span><span class="priority"><b>{{ $todo->priority }}</b></span>&nbsp;&nbsp<span class="assigned"><b>{{$todo->assigned}}</b></span>&nbsp;&nbsp<span><button type='button' class='btn btn-link' data-toggle='modal' data-target='#detailsModal' @click="getDetail($event, '{{ $todo->details }}')"><span v-if="'{{ $todo->details }}'">Detaljer</span></button></span></span></li>
                        @endif
                    @endforeach
                </ul>
                <ul class="mt-3 border border-gray-300 border-opacity-70">
                    <li class="pl-2"><h5 class="py-2 text-xl text-green-600">Avklarat</h5></li>
                    @foreach ($belongingtodos as $todo)
                        @if($todo->status === 'd')
                            <li class="list-group-item"><a class="todolink" href="/todos/{{ $todo->id }}/edit">{{ $todo->title }}</a><span class="todoline"><span class="deadline"> Deadline: <b>{{ $todo->deadline }}</b>&nbsp;&nbsp;</span><span class="priority"><b>{{ $todo->priority }}</b></span>&nbsp;&nbsp<span class="assigned"><b>{{$todo->assigned}}</b></span>&nbsp;&nbsp<span><button type='button' class='btn btn-link' data-toggle='modal' data-target='#detailsModal' @click="getDetail($event, '{{ $todo->details }}')"><span v-if="'{{ $todo->details }}'">Detaljer</span></button></span></span></li>
                        @endif
                    @endforeach
                </ul>
            @endif
            </div>
        </div>
    </div>
</x-headless-app>
