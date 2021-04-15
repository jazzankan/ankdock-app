<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-7 gap-5">
                <div class="col-span-4">
                    <h1 class="text-3xl mb-3">Blogginlägg</h1>
                    <p class="mb-4"><a href="/articles/create" class="btn-blue text-xs font-bold">Nytt inlägg</a> <a
                            class="btn-blue text-xs font-bold" href="/blog">Publik blogg</a></p>
                    <hr>
                    <ul>
                        @foreach ($articles as $art)
                            <li class="todo pl-2 py-2.5"><h4><a class="dashlink text-xl"
                                        href="/articles/{{ $art->id }}/edit">{{ $art->heading }}</a>
                                </h4>
                                Skapad: {{ $art->created_at->format('Y-m-d') }}<br>
                                @if($art->published === "yes")
                                    <span class="text-green-600">Publicerad</span>
                                @else
                                    <span class="text-red-600">Opublicerad</span>
                                @endif</li>
                        @endforeach
                    </ul>
                    <p>
                        {{$articles->render()}}
                    </p>
                </div>
                <div class="col-span-3 pl-2 bg-yellow-100 border-0 rounded-lg">
                    <h2 class="text-2xl mb-3">Blogganteckningar</h2>
                    <p>5 senaste från "Minnesgrejer" med tag "bloggidéer".</p>
                    @foreach ($blogideas as $bi)
                        <p><strong>{{$bi->title}}</strong><br>
                            {{$bi->description}}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-headless-app>
