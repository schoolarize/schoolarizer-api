<?php

namespace Schoolarize\Schoolarizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
use App\User;

class GenerateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:users {--count=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate users';

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
        if($this->option('count')){
            for ($i=0; $i < $this->option('count'); $i++) { 
                User::create([
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                    'remember_token' => Str::random(10),
                ]);
            }
        }
       
        $this->info('Users Generated');
    }


}
