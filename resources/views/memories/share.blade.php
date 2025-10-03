<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <div class="ml-2">
                <p>Till vem/vilka ska minnet "<span class="italic">{{ $memory->title }}</span>" delas ut?</p>
                <form name="sharememstore" action="{{ route('sharedmemories.store') }}" method="POST">
                    @csrf
                 <div class="mb-6">
                <select class="border mt-6 mb-2" multiple name="memshare[]">
                    @foreach($usersminusme as $s)
                        <option value ="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                </div>
                    <div>
                    <input type="hidden" name="memory_id"  value="{{ $memory->id }}">
                    </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dela</button>
                </form>
                <div>
                    @if ($errors->any())
                        <div class="text-red-600 bg-pink-200 mt-2 py-4 pl-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                </div>
        </div>
    </div>
</x-headless-app>
