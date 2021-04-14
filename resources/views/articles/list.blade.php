<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Blogginlägg</h1>
            <p><a href="/articles/create" class="btn btn-primary btn-sm">Nytt inlägg</a> <a href="/blog" class="btn btn-primary btn-sm">Publik blogg</a></p>
            <hr>
            <ul>
                @foreach ($articles as $art)
                    <li class="todo pl-2 py-2.5"><h4><a href="/articles/{{ $art->id }}/edit">{{ $art->heading }}</a></h4>
                        Skapad: {{ $art->created_at->format('Y-m-d') }}<br>
                        @if($art->published === "yes")
                            <span class="published"><strong>Publicerad</strong></span>
                        @else
                            <span class="unpublished"><strong>Opublicerad</strong></span>
                        @endif</li>
                @endforeach
            </ul>
            <p>
                {{$articles->render()}}
            </p>
        </div>
        <div class="col-sm-4" style="background-color:#ffffcc">
            <h2 class="text-2xl mb-3">Blogganteckningar</h2>
            <p>5 senaste från "Minnesgrejer" med tag "bloggidéer".</p>
            @foreach ($blogideas as $bi)
                <p><strong>{{$bi->title}}</strong><br>
                    {{$bi->description}}</p>
                <hr>
                @endforeach
        </div>
    </div>
</x-headless-app>
