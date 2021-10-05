<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Todo;
use App\Models\Memory;
use App\Models\User;
use App\Notifications\NeardeadProject;
use App\Notifications\NeardeadTodo;
use App\Notifications\OnceRemembered;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $date = new \DateTime();
            $latedate = $date->add(new \DateInterval('P3D'));
            $latedate = $latedate->format('Y-m-d');
            $neardeadproj = Project::where('deadline', $latedate)->get();
            if ($neardeadproj) {
                foreach ($neardeadproj as $ndp) {
                    $u = $ndp->users()->wherePivot('project_id', $ndp->id)->get();
                    foreach ($u as $unote) {
                        sleep(5);
                        $unote->notify(new NeardeadProject($ndp));
                    }
                }
            }
            $today = new \DateTime();
            $today = $today->format('Y-m-d');
            $neardeadtodo = Todo::where('status','!=','d')->where('deadline', $today)->get();
            if ($neardeadtodo) {
                foreach ($neardeadtodo as $ndt) {
                    $project = Project::where('id', $ndt->project_id)->first();
                    $u = $project->users()->wherePivot('project_id',$ndt->project_id)->get();
                    foreach ($u as $unote) {
                        sleep(5);
                        $unote->notify(new NeardeadTodo($ndt));
                    }
                }
            }
            $rmemory = Memory::where('date',$today)->get();
            if ($rmemory) {
                foreach ($rmemory as $rmem) {
                    sleep(5);
                    $u = User::where('id',$rmem['user_id'])->firstOrFail();
                    $u->notify(new OnceRemembered($rmem));
                    if($rmem['reminder'] === 'yearly') {
                        $newdate = Carbon::now()->addYear()->format('Y-m-d');
                        DB::table('memories')->where('id',$rmem->id)->update(['date' => $newdate]);
                    }
                }
            }
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
