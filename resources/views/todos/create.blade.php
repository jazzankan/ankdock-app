<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-3">Arbetsuppgift i projektet <span class="text-blue-400">{{ $taskProject->title }}</span></h1>
            <div>
                <form method="post" action="{{ route('todos.store') }}">
                    @csrf
                    <div class="pl-2">
                        <label for="title">Uppgift:</label><br>
                        <input type="text" maxlength="45" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ old('title') }}" name="title"/>
                        <div>
                            <label for="description">Detaljer:</label><br>
                            <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="description" name="details">{!! old('details') !!}</textarea>
                        </div>
                        <div class="mt-5"><label for="deadline">Deadline om det finns:</label><br>
                            <input type="date" class="border rounded-lg mb-6" value="{{ old('deadline') != null ? old('deadline') : ''}}" name="date">
                        </div>
                        <div class="mb-6">
                            <label><input type="radio" name="priority" value="l" {{ (old('priority') === 'l') ? 'checked' : '' }}> Lågprioriterad</label>
                            <label><input type="radio" name="priority" value="m" {{ (old('priority') === 'l' || old('prio') === 'h') ? '' : 'checked' }}> Medelprioriterad</label>
                            <label><input type="radio" name="priority"  value="h" {{ (old('priority') === 'h') ? 'checked' : '' }}> Högprioriterad</label>
                        </div>
                        <div>
                            <label for="title">Ska utföras av:</label>
                            <input type="text" class="border rounded-lg mb-6" value="{{ old('assigned') }}" name="assigned"/>
                        </div>
                        <div>
                            <input type="hidden" value="{{ $taskProject->id }}"  name="project_id"/>
                        </div>
                        <button type="submit" class="btn-blue">Skapa</button>
                    </div>
                </form>
            </div>
            <div>
                <p>
                @if ($errors->any())
                    <div class="text-red-600 bg-pink-200 mt-2 py-4 pl-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    </p>
            </div>
        </div>
    </div>
</x-headless-app>
