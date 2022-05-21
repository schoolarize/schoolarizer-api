<?php

namespace Schoolarize\Schoolarizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class GenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schoolarizer:generate 
                            {--dummy}
                            {--users}
                            {--activityLogs}
                            {--session}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dummy data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('users')) {
            $this->call('generate:users');
        }
        
        if ($this->option('activityLogs')) {
            $this->call('generate:activityLogs');
        }
        if($this->option('session')){
            $this->call('generate:session');
        }

        if($this->option('dummy')){
            $this->call('generate:users');
            $this->call('generate:activityLogs');
            $this->call('generate:session');
        }
    }


}
