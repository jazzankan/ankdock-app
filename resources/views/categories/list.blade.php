<x-headless-app>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-3">Kategorivård - för bloggen</h1>
            <p><a class="btn-blue text-xs font-bold" href="/categories/create" class="btn btn-primary btn-sm">Ny kategori</a></p>
            <ul class="list-group striped-list">
                @foreach ($categories as $cat)
                    <li class=""><h4><a href="/categories/{{ $cat->id }}/edit">{{ $cat->name }}</a></h4>
                @endforeach
            </ul>
        </div>
    </div>
</x-headless-app>
