<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CKeditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    //Variablerna är för projekt, men det används också för bloggartiklar.
    // För att detta ska funka i produktionsmiljön har filen dotlist.blade.php skapats
    public function editlist($description){
        $projdescription = str_replace("<ul>","<ul class='dot'>",$description);
        $projdescription = str_replace("<ol>","<ol class='num'>",$projdescription);
        $projdescription = str_replace("<h1>","<h1 class='sone'>",$projdescription);
        $projdescription = str_replace("<h2>","<h2 class='stwo'>",$projdescription);
        $projdescription = str_replace("<h3>","<h3 class='sthree'>",$projdescription);
        return $projdescription;
    }
}
