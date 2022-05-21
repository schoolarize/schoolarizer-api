<?php

namespace Schoolarize\Schoolarizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schoolarizer:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands necessary to prepare Schoolarizer for use';

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
        $this->call('vendor:publish', [
            '--tag' => 'schoolarizer-install',
            '--force' => true
        ]);
        //$this->call('passport:install', ['--force' => true]);
    }


}
