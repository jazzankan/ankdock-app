<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Typ av mat</h1>
            <p><a class="btn-blue text-xs font-bold" href="/typeoffoods/create" class="btn btn-primary btn-sm">Ny typ av mat</a></p>
            <ul class="mt-4">
                @foreach ($typeoffoods as $type)
                    <li class="todo pl-2 py-2.5"><h4><a class="dashlink" href="/typeoffoods/{{ $type->id }}/edit">{{ $type->name }}</a></h4>
                @endforeach
            </ul>
        </div>
    </div>
</x-headless-app>
