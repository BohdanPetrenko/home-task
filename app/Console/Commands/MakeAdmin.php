<?php

namespace App\Console\Commands;

use App\Repositories\User\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;
use Throwable;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign user an \'admin\' role';

    /**
     * Execute the console command.
     *
     * @param UserRepository $userRepository
     *
     * @return mixed
     */
    public function handle(UserRepository $userRepository)
    {
        $email = $this->argument('email');

        try {
            $user = $userRepository->findByEmail($email);
        } catch (ModelNotFoundException $exception) {
            $this->error("User with email '{$email}' does not exist in system");

            return;
        }

        if ($user->hasRole('admin')) {
            $this->warn("User with email '{$email}' already has admin rights");

            return;
        }

        try {
            $user->removeRole('user')->assignRole('admin');
        } catch (Throwable $t) {
            $this->error("Making user an admin failed: {$t->getMessage()}");

            return;
        }

        $this->info("Success! User {$user->name} with email {$email} is an administrator now");
    }
}
