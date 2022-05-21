<?php

namespace Schoolarize\Schoolarizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
use App\User;

class GenerateActivityLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:activityLogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate activity logs dummy data for users';

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
    public function handle(Faker $faker)
    {
        //Retrieve all the users
        $this->info('Checking if users exist.....');
        $users = User::all();
        //Check if users really exist
        if (count($users)) {
            $this->info('Now generating activity logs........');
            foreach ($users as $user) {
                for ($i=0; $i < 5; $i++) { 
                    $user->activityLogs()->create([
                        'activity_log' => $faker->text()
                    ]);
                }
            }
            $this->info('User actvity logs dummy data generated successfully');
            return;
        }
        $this->info('Dummy data not generate -- no users');
    }


}
