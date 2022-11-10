<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'admin:create {--u|user_name= : Username of the newly created admin.} {--e|email= : E-Mail of the newly created admin.}';


    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Manually creates a new admin.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->option('user_name');
        if ($name === null) {
            $name = $this->ask('Please enter your username.');
        }

        $email = $this->option('email');
        if ($email === null) {
            $email = $this->ask('Please enter your E-Mail.');
        }

        $password = $this->secret('Please enter a new password.');
        $password_confirmation = $this->secret('Please confirm the password');

        if($password !== $password_confirmation){
            $this->info('Passwords do not match');
            return;
        }

        try {
            $user = User::create([
                'user_name' => $name,
                'role' => 'admin',
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $this->info('Admin user '. $user->user_name. ' created successfully!');
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }
    }
}
