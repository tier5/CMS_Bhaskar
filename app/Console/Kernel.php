<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Client;

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

       $schedule->call(function(){
        $datetime1=Carbon::now()->addSeconds(-5);
   
   //$clients=Client::where('updated_at','<=',$datetime1)->update(['status'=>0]);
  $clients=Client::all();
           foreach($clients as $client)
           {
             if($client->updated_at<=$datetime1)
             {
                $client->status=0;
               $client->update();
             }
             else
             {
              $client->status=1;
               $client->update();
             }
           }
       })->everyMinute();
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
