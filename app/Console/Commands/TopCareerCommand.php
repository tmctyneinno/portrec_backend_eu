<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TopCareerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:top-career-command';
    protected $signature = 'topCareer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run this command to update the top career table, also delete non-exising users and users not on this list';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        
        
    }


}
