<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-3">Redigera projektet <span class="text-blue-800">{{ $project->title }}</span></h1>
            @if($project->visible === 'n')<h2 class="text-xl pl-2 mb-3 mt-3 text-red-600 font-bold">ARKIVERAT PROJEKT!</h2>@endif
            <div>
                <form method="post" action="/projects/{{ $project->id  }}">
                    @method('PATCH')
                    @csrf
                    <div class="pl-2">
                        <label for="title">Namn:</label><br>
                        <input type="text" class="max-w-lg w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" value="{{ $project->title }}" name="title"/>
                        <div>
                            <label for="description">Beskrivning:</label><br>
                            <textarea class="mb-6 w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="description" name="description">{!! $project->description !!}</textarea>
                        </div>
                        <div class="mt-5"><label for="deadline">Deadline om det finns:</label><br>
                            <input type="date" class="border rounded-lg mb-6" value="{{ ($project->deadline != null) ? $project->deadline : '' }}" name="date">
                        </div>
                        <div class="mb-6">
                            <label><input type="radio" name="must" value="y" {{ ($project->must != 'n') ? 'checked' : '' }}> Plikt</label>
                            <label><input type="radio" name="must" {{ ($project->must === 'n') ? 'checked' : '' }} value="n"> Hobby eller nöje</label>
                        </div>
                        <div>
                            Dela projektet med:<br>
                            <select multiple name="selshare[]">
                                @foreach($usernames as $s)
                                    @if(in_array( $s, $sharing))
                                        <option value ="{{ $s }}" selected>{{ $s }}</option>
                                    @else
                                        <option value ="{{ $s }}">{{ $s }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" value="n" name="visible"/>
                        </div>
                        <div class="mt-3" x-data="{ archive:true, erase:true }">
                            @if($project->visible === 'n')<p x-show="archive" class="mb-2"><input type="checkbox" class="form-checkbox" id="visible" name="visible" value="y" x-on:click="erase = ! erase">
                                <label class="" for="visible">Aktivera projektet igen.</label></p>@endif
                                @if($project->visible === 'y')<p x-show="archive" class="mb-2"><input type="checkbox" class="form-checkbox" id="invisible" name="invisible" value="y" x-on:click="erase = ! erase">
                                    <label class="" for="visible">Arkivera projektet. Det syns då inte längre i den vanliga projektlistan.</label></p>@endif
                                <p x-show="erase" class="mb-2"><input type="checkbox" class="form-checkbox" id="delete" name="delete" value="delete" x-on:click="archive = ! archive">
                                <label class="" for="delete">Ta bort projektet för gott. All tillhörande data tas bort!</label></p>
                                @if($sharing)
                                <p><input type="checkbox" class="form-checkbox" id="sendmail" name="sendmail" value="sendmail" checked="checked">
                                    <label class="" for="sendmail">Skicka mail till dem  du delar projektet med.</label></p>
                                @endif

                        </div>
                        <button type="submit" class="mt-3 btn-blue">Spara</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('textarea'))
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error('Error during initialization of the editor', error);
        });
</script>

