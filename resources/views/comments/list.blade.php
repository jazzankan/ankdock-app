<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl">Nya bloggkommentarer</h1>
            @if(count($comments) > 0)
                <ul class="mt-4 list-decimal">
                    @foreach ($comments as $comment)
                        <li class="todo pl-2 py-3"><a class="text-blue-600 hover:underline" href="/comments/{{ $comment->id }}/edit"><strong>Kommentar:</strong></a> {{ $comment->body }}<br>
                            <strong>Hör till inlägget "{{ $comment->belongart['heading'] }}". Kommentaren skapad {{ $comment->created_at }}.  @if($comment->wishpublic ==='yes') <span class="redalert">Vill ha publicerad!</span> @endif </strong></li>
                    @endforeach
                </ul>
            @else
                <h4 class="text-xl mt-4">Det finns inga nya kommentarer!</h4>
            @endif
        </div>
    </div>
</x-headless-app>
