<?php

namespace Schoolarize\Schoolarizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use App\User;


class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--master} {--default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User ....';

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
        $user = new User();
        $user->name = 'JamesOpio';
        $user->email = 'stephen@gmail.com';
        $user->password = bcrypt('secret');
        $user->email_verified_at = now();

        $user->save();

        $user->role()->create([
            'role' => 'admin'
        ]);
        $this->info('User Created Successfully');
    }


}
