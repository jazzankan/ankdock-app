<?php

namespace \App\Providers;

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
    public function editlist($description){
        $projdescription = str_replace("<ul>","<ul class='dot'>",$description);
        $projdescription = str_replace("<ol>","<ol class='num'>",$projdescription);
        return $projdescription;
    }
}
