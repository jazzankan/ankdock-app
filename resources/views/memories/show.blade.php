<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="ml-2">
            <p><a class="btn-blue text-xs font-bold" href="/memories" class="btn btn-primary btn-sm">Minneslistan</a> <a class="btn-blue text-xs font-bold" href="/memories/{{ $memory->id }}/edit" class="btn btn-primary btn-sm">Redigera minnet</a> <a class="btn-blue text-xs font-bold" href="/memupload/{{ $memory->id }}" class="btn btn-primary btn-sm">Ladda upp fil</a>
            <h2>{{ $memory->title  }}</h2>
            @if($memory->description != null)
                <p><strong>Beskrivning: </strong> {!! nl2br(e($memory->description)) !!}</p>
            @endif
            @if($memory->source != null)
                <p><strong>Källa: </strong> {{ $memory->source  }}</p>
            @endif
            @if($memory->link != null)
                <p><strong>Länk: </strong> <a href="{{ $memory-> link  }}" target="_blank">{{ $memory-> link  }}</a></p>
            @endif
            <p><strong>Viktighet: </strong> {{ $memory-> importance  }}</p>
            <p><strong>Skapat: </strong> {{ $memory-> created_at  }}</p>
            @if($memory->updated_at != null && $memory->updated_at != $memory->created_at)
                <p><strong>Senast ändrat: </strong> {{ $memory-> updated_at  }}</p>
            @endif
                <p><strong>Taggar: </strong>@foreach($tags as $tag) {{ $tag->name }}&nbsp;@endforeach</p>

            </div>
        </div>
    </div>
</x-headless-app>
