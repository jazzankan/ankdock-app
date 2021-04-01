x-headless-app>
<div class="py-12">
    <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
        <div class="row justify-content-center">
            <div class="card">
                <h2 class="text-2xl">Ladda upp fil</h2>
                <div class="mt-4">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="text-red-600">
                            <strong>Aj då!</strong> Det var något problem med filen du valde.<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/uploadmemory" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile"
                                   aria-describedby="fileHelp">
                            <input type="hidden" name="memoryid" value="{{ $memoryid }}"><br>
                            <small id="fileHelp" class="form-text text-muted">Ladda upp Word- Excel- och PDF-filer.
                                Eller bild (.jpg .png .gif)</small>
                        </div>
                        <button type="submit" class="mt-4 btn-blue text-xs font-bold">Skicka</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </x-headless-app>
