<x-app-layout>
    <x-slot name="header">
        <p><img class="inline rounded" src="https://webbsallad.se/ankfiles/redduck100.png">
            <span class="ml-4 text-3xl text-red-900">Om Ankhemmet</span></p>
    </x-slot>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx-auto sm:px-6 lg:px-8 bg-white py-4">
            <p>Ankhemmet är en applikation gjord av Anders Fredriksson; en pensionerad biblioteksmedarbetare med
                kvardröjande passion för programmering.
                Det mesta är bakom inloggning och till för eget bruk, men det finns en öppen del i form av en <a
                    class="text-blue-600 hover:underline" href='/blog'>blogg</a>.</p>
            <p class="mt-3">Ankhemmet är ett Laravel-projekt (PHP), stajlat med <a class="text-blue-600 hover:underline"
                                                                                   href="https://tailwindcss.com/">Tailwind
                    CSS</a>, och aningen kryddat med <a class="text-blue-600 hover:underline"
                                                        href="https://github.com/alpinejs/alpine/">alpine.js</a></p>
            <div class="md:flex md:justify-center">
                <img src="https://webbsallad.se/ankfiles/jazzankan.png" alt="Anders">
            </div>
                <div class="md:flex md:justify-center -mt-12"><i>Själva Anders</i></div>
            </div>
        </div>
</x-app-layout>
