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
            @if(count($belongingfiles) > 0)
                <ul class="mt-4">
                    <li class="font-bold">Tillhörande filer: </li>
                    @foreach($belongingfiles as $f)
                        <li class="list-inline-item"><a class="text-blue-700 hover:underline" href="https://ank.webbsallad.se/storage/files/{{ $f->filename }}" target="_blank">{{ $f->filename }}</a></li>
                    @endforeach
                </ul>
            @endif
            @if(count($sharing) > 0)
                <ul class="mt-3">
                    <li class="font-bold">Projektet delas med: </li>
                    @foreach($sharing as $s)
                        <li class="">{{ $s }}</li>
                    @endforeach
                </ul>
            @endif
            @if(count($projcomments) > 0)
                <a name="comments"></a>
                <p class="mt-3"><span class="font-bold">Kommentarer:</span><br>
                @foreach($projcomments as $c)
                    @if($loop->iteration > 2)
                        @break
                    @endif
                    <p><span class="text-yellow-800">{{ $c->body }}</span><br><span class="text-xs">{{ $c->created_at }}</span><br><i><b>{{ $c->user->name }}</b></i><br>.....</p>
                @endforeach
            @endif
            <div x-data="{ isOpen: false }">
            @if(count($projcomments) > 2)
                <a x-on:click="isOpen = !isOpen" class="text-blue-600 hover:underline" href="#comments">Tidigare kommentarer:</a>
            @endif
            @foreach($projcomments as $c)
                @if($loop->iteration > 2)
                        <div x-show="isOpen"><span class="text-yellow-800">{{ $c->body }}</span><br><span class="text-xs">{{ $c->created_at }}</span><br><i><b>{{ $c->user->name }}</b></i><br>.....</div>
                @endif
            @endforeach
            </div>
            <hr>
        </div>
        <hr class="my-4">
        <div class="pl-2">
        <h2 class="text-2xl mb-3">Arbetsuppgifter</h2>
        <a href="/todos/create/{{ $project->id }}" class="btn-blue text-xs font-bold">Skapa arbetsuppgift</a>
        <div class="mt-4">
            @if($belongingtodos->isNotEmpty())
                <a name="todos"></a>
                <ul class="border border-gray-300 border-opacity-70">
                    <li class="pl-2"><h5 class="py-2 text-xl text-red-600">Ogjort</h5></li>
                    @foreach ($belongingtodos as $todo)
                        @if($todo->status === 'n')
                            <li x-data="{ isOpen: false }" class="todo pl-2 py-2.5"><a class="text-blue-700 hover:underline" href="/todos/{{ $todo->id }}/edit">{{ $todo->title }}</a><span class="float-right mr-4"> Deadline: <span @if($todo['deadline'] <= $today)class="text-red-600"@endif><b>{{ $todo->deadline }}</b></span>&nbsp<span class=""><b>{{ $todo->priority }}</b></span>&nbsp<span class=""><b>{{$todo->assigned}}</b></span>&nbsp<span>@if($todo->details) <a x-on:click="isOpen = !isOpen" class="text-blue-700 hover:underline" href="#todos">Detaljer</a>@endif</span></span><br>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-500 transform" x-transition:enter-start="opacity-0 transform scale-90" x-transition:leave="transition ease-in duration-500 transform" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" style='white-space:pre-wrap'>{{ $todo->details }}</div></li>
                        @endif
                    @endforeach
                </ul>
                <ul class="mt-3 border border-gray-300 border-opacity-70">
                    <li class="pl-2"><h5 class="py-2 text-xl text-yellow-600">Pågående</h5></li>
                    @foreach ($belongingtodos as $todo)
                        @if($todo->status === 'o')
                            <li x-data="{ isOpen: false }" class="todo pl-2 py-2.5"><a class="text-blue-700 hover:underline" href="/todos/{{ $todo->id }}/edit">{{ $todo->title }}</a><span class="float-right mr-4"> Deadline: <span @if($todo['deadline'] <= $today)class="text-red-600"@endif><b>{{ $todo->deadline }}</b></span>&nbsp<span class=""><b>{{ $todo->priority }}</b></span>&nbsp<span class=""><b>{{$todo->assigned}}</b></span>&nbsp<span>@if($todo->details) <a x-on:click="isOpen = !isOpen" class="text-blue-700 hover:underline" href="#todos">Detaljer</a>@endif</span></span><br>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-500 transform" x-transition:enter-start="opacity-0 transform scale-90" x-transition:leave="transition ease-in duration-500 transform" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" style='white-space:pre-wrap'>{{ $todo->details }}</div></li>
                        @endif
                    @endforeach
                </ul>
                <ul class="mt-3 border border-gray-300 border-opacity-70">
                    <li class="pl-2"><h5 class="py-2 text-xl text-green-600">Avklarat</h5></li>
                    @foreach ($belongingtodos as $todo)
                        @if($todo->status === 'd')
                            <li x-data="{ isOpen: false }" class="todo pl-2 py-2.5"><a class="text-blue-700 hover:underline" href="/todos/{{ $todo->id }}/edit">{{ $todo->title }}</a><span class="float-right mr-4"> Deadline: <span><b>{{ $todo->deadline }}</b></span>&nbsp<span class=""><b>{{ $todo->priority }}</b></span>&nbsp<span class=""><b>{{$todo->assigned}}</b></span>&nbsp<span>@if($todo->details) <a x-on:click="isOpen = !isOpen" class="text-blue-700 hover:underline" href="#todos">Detaljer</a>@endif</span></span><br>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-500 transform" x-transition:enter-start="opacity-0 transform scale-90" x-transition:leave="transition ease-in duration-500 transform" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" style='white-space:pre-wrap'>{{ $todo->details }}</div></li>
                        @endif
                    @endforeach
                </ul>
            @endif
            </div>
        </div>
    </div>
</x-headless-app>
