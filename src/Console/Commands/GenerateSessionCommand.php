<?php

namespace Schoolarize\Schoolarizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Schoolarize\Schoolarizer\Models\Session\Session;

use Faker\Generator as Faker;

class GenerateSessionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:session';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate session dummy data';

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
        Session::create([
            'name' => Str::random(10),
            'start_date' => '2022-01-'.$faker->numberBetween(1, 30),
            'end_date' => '2022-12-'.$faker->numberBetween(1, 30)
        ]);
    }


}
