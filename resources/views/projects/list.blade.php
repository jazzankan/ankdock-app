<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-2">Mina projekt</h1>
            <div class="my-4 pl-2">
                <a href="/projects/create" class="btn-blue text-xs font-bold">Nytt projekt</a> <a class="btn btn-blue text-xs font-bold"href="/projects?arkiv=y">Arkiverade projekt</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm border-2 mt-5">
                <div>
                    @if(count($visibleproj)>0)
                        @php
                            $bcolor = false;
                        @endphp
                        <ul>
                            @foreach ($visibleproj as $project)
                                <li class="py-4 pl-2 border-b-2 @if($bcolor)bg-blue-100" @else " @endif><h4 class="text-xl text-blue-700"><a class="hover:underline" href="/projects/{{ $project->id }}">{{ $project->title }}</a></h4> <span class="must">@if($archived)<b>ARKIVERAT PROJEKT!</b><br>@endif</span><span class="text-red-600">@if($project['must']=='y')Plikt!<br>@endif</span> @if($project['deadline']) Deadline: <span @if($project['deadline'] <= $today)class="text-red-600"@endif>{{ $project->deadline }}</span>@endif<br>@if($project['late'])<span class="redalert">Det finns minst en försenad arbetsuppgift!</span>@endif</li>
                                    @if($bcolor == false)
                                        @php($bcolor = true)
                                    @else
                                        @php($bcolor = false)
                                    @endif
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
