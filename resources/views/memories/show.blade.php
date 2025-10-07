<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="ml-2">
                <p><a class="btn-blue text-xs font-bold" href="/memories">Minneslistan</a>@if($memory->user_id == auth()->user()->id) <a class="btn-blue text-xs font-bold" href="/memories/{{ $memory->id }}/edit">Redigera minnet</a> <a class="btn-blue text-xs font-bold" href="/memupload/{{ $memory->id }}">Ladda upp fil</a></p>
                <p class="mt-4"><a class="btn-blue text-xs font-bold" href="/memories/{{ $memory->id }}/share">Dela minnet</a></p>@endif
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
                @if($memory->reminder === 'noreminder' || $memory->reminder == null)
                    <strong>Ingen påminnelse</strong>
                @else
                <p><strong>Påminnelse: </strong> {{ $memory-> date }} , @if($memory->reminder === 'yearly')årlig.@endif @if($memory->reminder === 'once') en gång.@endif</p>
                    @if($today > $memory->date)
                        <p class="text-red-600 font-bold">Påminnelsedatum är passerat!</p>
                    @endif
                @endif
                @if($sharing_users)
                    <p class="text-sm text-green-700">Minnet delat till {{ $sharing_users }}</p>
                @endif
                @if($mailfail)
                    <p class="text-sm text-red-700">{{ $mailfail }}</p>
                @endif
                @if(count($belongingfiles) > 0)
                    <ul class="list-group-horizontal nomargin">
                        <li><strong>Tillhörande filer:</strong> </li>
                        @foreach($belongingfiles as $f)
                            <li class="list-inline-item"><a target="_blank" class="" href="https://ank.webbsallad.se/storage/files/{{ $f->filename }}"><img class="mb-4" src="https://ank.webbsallad.se/storage/files/{{ $f->filename }}" alt="bild" style="width:140px"></a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-headless-app>
