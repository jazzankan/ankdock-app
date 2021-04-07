<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            @if(count($memories) > 0)
                <h1 class="text-3xl pl-2 mb-3">Minnen</h1>
                <div class="ml-2" x-data="{memfilter:false}">
                <form method="post" action="{{ route('memories.index') }}">
                    @csrf
                    <p class="mb-3"><a href="/memories/create" class="btn-blue text-xs font-bold">Nytt minne</a></p>
                    <input type="text" class="max-w-sm w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $searchterm }}" name="search"/> <button type="submit" class="btn-blue text-xs font-bold"
                    >Sök</button>
                    <a  class="ml-3 text-blue-700 hover:underline" href="#" x-on:click="memfilter = !memfilter"><b>Filtrera</b></a>
                    <div class="mb-5" x-show="memfilter">
                        <p><label for="tag">Tagg:</label>
                            @if($tags)
                                <select class="border mb-6" id="tag" name="tag">
                                    <option value=""></option>
                                    @foreach($tags as $t)
                                        <option value ="{{ $t['id'] }}">{{ $t['name'] }}</option>
                                    @endforeach
                                    @endif
                                </select>
                        </p>
                        <p><label for="importance">Viktighet:</label>
                            <select class="border mb-6" id="importance" name="importance">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select></p>
                        <p><label for="fromdate">Från:</label>
                            <input class="border rounded-lg mb-6" type="date" value="" name="fromdate"/>
                            <label for="todate">Till:</label>
                            <input class="border rounded-lg mb-6" type="date" value="" name="todate"/></p>
                    </div>
                </form>
                <div>
                    @if ($errors->any())
                        <div class="text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <ul class="border border-gray-300 border-opacity-70">
                    @foreach ($memories as $memory)
                        <li class="todo pl-2 py-2.5"><h4 class="text-xl"><a class="text-blue-700 hover:underline" href="/memories/{{ $memory->id }}">{{ $memory->title }}</a></h4></li>
                    @endforeach
                </ul>
                <p>
                    {{$memories->render()}}
                </p>
            @elseif($searchterm)
                <h2>Inga träffar!</h2>
                <p><a href="/memories" class="btn btn-primary btn-sm">Minneslistan</a></p>
            @else
                <h2>Det finns inget...</h2>
                <p><a href="/memories/create" class="btn btn-primary btn-sm">Nytt minne</a></p>
            @endif
                </div>
        </div>
    </div>
</x-headless-app>
