<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div>
                <p class="text-xl mb-4">Minnen som delats av andra till dig:</p>
            </div>
            <div>
                <ul class="border border-gray-300 border-opacity-70">
                    @foreach ($memories as $memory)
                        <li class="todo pl-2 py-2.5">
                            <h4 class="text-xl"><a class="text-blue-700 hover:underline"
                                                   href="/memories/{{ $memory->id }}">{{ $memory->title }}</a>
                                <p class="text-sm">Delat av {{ $memory->user->name }}</p>
                            </h4>
                            <span class="text-gray-500 text-xs">Skapat {{ substr($memory->created_at,0,10) }},
                            delat {{ $memory->sharetime }} @if($memory->sharetime >= $newmemory)<span class="text-red-700"><strong>NYTT</strong></span>  @endif</span></li>
                    @endforeach
                </ul>
            </div>
</x-headless-app>
