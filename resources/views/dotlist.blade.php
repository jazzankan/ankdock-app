<x-app-layout>
    <x-slot name="header">
        <p><img class="inline rounded" src="https://webbsallad.se/ankfiles/redduck100.png">
            <span class="ml-4 text-2xl md:text-3xl text-red-900">Om Ankhemmet</span></p>
    </x-slot>
    <div class="py-12 pl-2">
        <div class="max-w-screen-lg mx:auto sm:px-6 lg:px-8 bg-white py-4">
            <h1 class="text-4xl text-red-700">Den här filen skapades endast för att fixa punklistor och rubriker </h1>
            <p>Alla klasser som inte används i koden rensas av Tailwinds purgeCSS. Och de här klsserna (dot,num)
            flyger ju in via CKeditorServiceProvider.</p>
            <ul class="dot">
                <li>ett</li>
                <li>två</li>
            </ul>
            <ol class="num">
                <li>ett</li>
                <li>två</li>
            </ol>
            <h1 class="sone">Rubrik 1</h1>
            <h2 class="stwo">Rubrik 2</h2>
            <h3 class="sthree">Rubrik 3</h3>
            <div class="flex justify-center -mt-12"><i>Själva Anders</i></div>
        </div>
    </div>
</x-app-layout>
