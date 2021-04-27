<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-7 gap-20">
                <div class="col-span-4">
                    @if (isset($thanks))
                        <h4 class="thankyou">{{ $thanks }}</h4>
                    @endif
                    @if($articles->isNotEmpty())
                        @foreach($articles as $key => $art)
                            <div x-data="{ isOpen: false }">
                                <h2 class="text-2xl" text-2xl id="{{ $key }}"><a class="dashlink" href="#{{ $key }}"
                                                                                 x-on:click="isOpen = !isOpen">{{$art->heading}}</a>
                                </h2>
                                <div x-show="isOpen" class="{{ $key }} my-3">{!! $art->body !!}
                                    @if(count($art->comments) > 0)<p class="mt-4">Kommentarer:</p>
                                    @foreach($art->comments as $com)
                                        <p class="my-2"><span class="text-yellow-900">{{ $com->body }}</span><br><b>{{ $com->name }}</b>
                                        </p>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <p>Kategori: {{ $art->catname }}</p>
                            <p>Publicerad: {{$art->updated_at->format('Y-m-d')}}</p>
                            <div class="{{ $key }}" style="display:none;">
                                <p>Direktlänk: <a
                                        href="https://<?php echo $server = $_SERVER['SERVER_NAME'];?>/articles/{{ $art->id }}">https://<?php echo $server = $_SERVER['SERVER_NAME'];  ?>
                                        /articles/{{ $art->id }}</a></p>
                            </div>
                            <p><a class="text-blue-600 hover:underline" href="comments/create?artid={{ $art->id }}">Återkoppla/Kommentera</a>
                            </p>
                            <hr class="my-5 border-blue-300 border-dashed border-1.5">
                        @endforeach
                        <p>
                            {{$articles->render()}}
                        </p>
                    @else
                        <h3>Du kammade noll!</h3>
                    @endif
                </div>
                <div class="col-span-3">
                    <form id="search" method="post" action="/blog">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="border rounded-lg text-gray-700" value="{{ $searchterm }}" name="search"/>
                            <button type="submit" class="btn-blue">Sök</button>
                        </div>
                    </form>
                    <h2 class="text-2xl mt-4">Kategorier</h2>
                    <div>
                        <ul class="list-group">
                            @if($requestcid || $searchterm)
                                <li><a class="text-blue-600 hover:underline font-bold" href="#"
                                       onclick="blogcatall()"><h5 id="allfat"
                                                                     @if($requestcid == "allcat")style='color:green;font-weight:600'@endif>
                                            Alla ({{ $allart }})</h5></a></li>@endif
                            <form id="showall" action="/blog">
                                <input type="hidden" id="allcat" name="cid" value="allcat">
                            </form>
                            @foreach($categories as $c)
                                <form id="c{{ $c->id }}" action="/blog">
                                    <input type="hidden" name="cid" value="{{ $c->id }}">
                                    <li class="my-2"><a class="text-blue-600 hover:underline font-bold" href="#"
                                                        onclick="blogcatcid('c{{ $c->id}}')">
                                            <h5 @if($requestcid == $c->id)style='color:green;font-weight:600'@endif>{{$c->name }}
                                                ({{$c->numcat }})</h5></a></li>
                                </form>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function blogcatcid(cid) {
            document.getElementById(cid).submit()
        }
    </script>
    <script>
        function blogcatall(cid) {
            document.getElementById('showall').submit();
        }
    </script>
</x-headless-app>
