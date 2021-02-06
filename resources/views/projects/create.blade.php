<x-headless-app>
    <div class="py-12">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl pl-2 mb-2">Skapa nytt projekt</h1>
        <div>
            <form method="post" action="{{ route('projects.store') }}">
                @csrf
                <x-input></x-input>
            </form>
        </div>
    </div>
</x-headless-app>
