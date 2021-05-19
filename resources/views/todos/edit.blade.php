<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-3">Redigera <span class="text-blue-400">{{ $todo->title }}</span></h1>
            <h3 class="text-xl pl-2 mb-5">Arbetsuppgift i projektet "{{ $project->title }}"</h3>
            <div>
                <form method="post" action="/todos/{{ $todo->id }}">
                    {{ method_field('PATCH') }}
                    @csrf
                    <fieldset class="pl-2 mb-5">
                        <label for="status">Status:</label><br>
                        <label><input type="radio" name="status" value="n" {{ ($todo->status === 'n') ? 'checked' : '' }}> Ny </label>
                        <label><input type="radio" name="status" value="o" {{ ($todo->status === 'o') ? 'checked' : '' }}> Pågående </label>
                        <label><input type="radio" name="status" value="d" {{ ($todo->status === 'd') ? 'checked' : '' }}> Avklarad </label>
                    </fieldset>
                    <div class="pl-2">
                        <label for="title">Uppgift:</label><br>
                        <input type="text" maxlength="45" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $todo->title }}" name="title"/>
                        <div>
                            <label for="description">Detaljer:</label><br>
                            <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="description" name="details">{!! $todo->details !!}</textarea>
                        </div>
                        <div class="mt-5"><label for="deadline">Deadline om det finns:</label><br>
                            <input type="date" class="border rounded-lg mb-6" value="{{ ($todo->deadline != null) ? $todo->deadline : ''}}" name="date">
                        </div>
                        <div class="mb-6">
                            <label><input type="radio" name="priority" value="l" {{ ($todo->priority === 'l') ? 'checked' : '' }}> Lågprioriterad</label>
                            <label><input type="radio" name="priority" value="m" {{ ($todo->priority === 'm') ? 'checked' : '' }}> Medelprioriterad</label>
                            <label><input type="radio" name="priority"  value="h" {{ ($todo->priority === 'h') ? 'checked' : ''  }}> Högprioriterad</label>
                        </div>
                        <div>
                            <label for="title">Ska utföras av:</label>
                            <input type="text" class="border rounded-lg mb-6" value="{{ $todo->assigned }}" name="assigned"/>
                        </div>
                            <div>
                                <div class="mb-6">
                                    <input type="checkbox" class="form-checkbox" id="delete" name="delete" value="delete">
                                    <label for="delete">Ta bort arbetsuppgiften helt!</label>
                                </div>
                                <div class="mb-6">
                                    @if (count($shared) > 0)
                                    <div>
                                        <input type="checkbox" class="form-checkbox" id="smail" name="smail" value="smail" checked="checked">
                                        <label for="smail">Skicka mail till dem  du delar projektet med.</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div>
                            <input type="hidden" value="{{ $project->id }}"  name="project_id"/>
                        </div>
                        <button type="submit" class="btn-blue">Uppdatera</button>
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
