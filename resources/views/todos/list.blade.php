<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            @if(count($undonetodos) > 0)
                <div class="pl-2">
                    <h1 class="text-3xl mb-2">Ofärdiga arbetsuppgifter</h1>
                    <ul class="border border-gray-300 border-opacity-70">
                        @foreach ($undonetodos as $t)
                            <li class="todo pl-2 py-2.5"><h4 class="text-lg">{{ $t->title }}</h4> @if($t['deadline']) Deadline: <span
                                    @if($t['deadline'] <= $today)class="text-red-600"@endif>{{ $t->deadline }}</span>@endif
                                <br>
                                <h5>Tillhör projekt: <a class="dashlink" href="/projects/{{ $t->project_id }}">{{ $t->projname }}</a>
                                </h5></li>
                        @endforeach
                    </ul>
                    @else
                        <h2>Du har inga ogjorda arbetsuppgifter.</h2>
                    @endif
                </div>
        </div>
    </div>
</x-headless-app>
