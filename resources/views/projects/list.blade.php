<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border-2">
                <div class="pl-3">
                    <h1 class="text-3xl">Mina projekt</h1>
                    @if(count($visibleproj)>0)
                        <ul class="list-group striped-list pl-3">
                            @foreach ($visibleproj as $project)
                                <li class="list-group-item"><h4><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4> <span class="must">@if($archived)<b>ARKIVERAT PROJEKT!</b><br>@endif</span><span class="must">@if($project['must']=='y')Plikt!<br>@endif</span> @if($project['deadline']) Deadline: <span @if($project['deadline'] <= $today)class="redalert"@endif>{{ $project->deadline }}</span>@endif<br>@if($project['late'])<span class="redalert">Det finns minst en försenad arbetsuppgift!</span>@endif</li>
                            @endforeach
                        </ul>
                    @else
                        <h2 class="text-xl pt-8 text-red-500">Du har inga projekt på gång.</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-headless-app>
