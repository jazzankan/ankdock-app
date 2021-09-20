<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="ml-2">
            <p><a class="btn-blue text-xs font-bold" href="/memories">Minneslistan</a> <a class="btn-blue text-xs font-bold" href="/memories/{{ $memory->id }}/edit">Redigera minnet</a> <a class="btn-blue text-xs font-bold" href="/memupload/{{ $memory->id }}">Ladda upp fil</a>
            <h2 class="text-2xl my-4">{{ $memory->title  }}</h2>
            @if($memory->description != null)
                <p><strong>Beskrivning: </strong> {!! nl2br(e($memory->description)) !!}</p>
            @endif
            @if($memory->source != null)
                <p><strong>Källa: </strong> {{ $memory->source  }}</p>
            @endif
            @if($memory->link != null)
                <p><strong>Länk: </strong> <a class="text-blue-600 hover:underline" href="{{ $memory-> link  }}" target="_blank">{{ $memory-> link  }}</a></p>
            @endif
            <p><strong>Viktighet: </strong> {{ $memory-> importance  }}</p>
            <p><strong>Skapat: </strong> {{ $memory-> created_at  }}</p>
            @if($memory->updated_at != null && $memory->updated_at != $memory->created_at)
                <p><strong>Senast ändrat: </strong> {{ $memory-> updated_at  }}</p>
            @endif
                <p><strong>Taggar: </strong>@foreach($tags as $tag) {{ $tag->name }}&nbsp;@endforeach</p>
                @if($memory->reminder != null)
                <p><strong>Påminnelse: </strong> {{ $memory-> date }} , @if($memory->reminder === 'yearly')årlig.@endif @if($memory->reminder === 'once') en gång.@endif</p>
                @endif
                @if(count($belongingfiles) > 0)
                    <ul class="list-group-horizontal nomargin">
                        <li><strong>Tillhörande filer:</strong> </li>
                        @foreach($belongingfiles as $f)
                            <li class="list-inline-item"><a class="text-blue-600 hover:underline" href="https://ank.webbsallad.se/storage/files/{{ $f->filename }}" target="_blank">{{ $f->filename }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-headless-app>
