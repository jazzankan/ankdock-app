<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-2">Mina projekt</h1>
            <div class="bg-white overflow-hidden shadow-sm border-2">
                <div>
                    @if(count($visibleproj)>0)
                        @php
                            $bcolor = 0;
                        @endphp
                        <ul>
                            @foreach ($visibleproj as $project)
                                @if($bcolor ==1)
                                <li class="py-4 pl-2 border-b-2 bg-blue-100"><h4 class="text-xl text-blue-700"><a class="hover:underline" href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4> <span class="must">@if($archived)<b>ARKIVERAT PROJEKT!</b><br>@endif</span><span class="text-red-600">@if($project['must']=='y')Plikt!<br>@endif</span> @if($project['deadline']) Deadline: <span @if($project['deadline'] <= $today)class="text-red-600"@endif>{{ $project->deadline }}</span>@endif<br>@if($project['late'])<span class="redalert">Det finns minst en försenad arbetsuppgift!</span>@endif</li>
                                @else
                                    <li class="py-4 pl-2 border-b-2"><h4 class="text-xl text-blue-700"><a class="hover:underline" href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4> <span class="must">@if($archived)<b>ARKIVERAT PROJEKT!</b><br>@endif</span><span class="text-red-600">@if($project['must']=='y')Plikt!<br>@endif</span> @if($project['deadline']) Deadline: <span @if($project['deadline'] <= $today)class="text-red-600"@endif>{{ $project->deadline }}</span>@endif<br>@if($project['late'])<span class="redalert">Det finns minst en försenad arbetsuppgift!</span>@endif</li>
                                @endif
                                    @php
                                    if($bcolor == 0)
                                    $bcolor == 0 ? 1 : 0;
                                    @endphp
                            @endforeach
                        </ul>
                    @else
                        <h2 class="pl-2 text-xl pt-8 text-red-500">Du har inga projekt på gång.</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-headless-app>
