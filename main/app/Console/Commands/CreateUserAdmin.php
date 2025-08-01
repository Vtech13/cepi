<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create 3 users AdminCMS + Admin Platform + SuAdmin';

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
     * @return int
     */
    public function handle()
    {
        $users = [
            [
                'ref_user_role_id' => UserRole::SU_ADMIN,
                'firstname'        => 'Valentin',
                'lastname'         => 'Dev',
                'email'            => 'dev@webcorporate.fr',
                'password'         => Hash::make('c/1h@@iG>B/d~$EFG:(DeE'),
                'active'           => 1,
                'created_user_id'  => 1,
                'updated_user_id'  => 1,
                'created_at'       => now(),
                'updated_at'       => now()
            ],
            [
                'ref_user_role_id' => UserRole::ADMIN,
                'firstname'        => 'Pauline',
                'lastname'         => 'Pagbe',
                'email'            => 'dr.pagbe@clinique-cepi.com',
                'password'         => Hash::make('kJ|ZqkdxdC)U'),
                'active'           => 1,
                'created_user_id'  => 1,
                'updated_user_id'  => 1,
                'created_at'       => now(),
                'updated_at'       => now()
            ],
            [
                'ref_user_role_id' => UserRole::ADMINCMS,
                'firstname'        => 'Pauline',
                'lastname'         => 'Admin',
                'email'            => 'pagbe.pauline@gmail.com',
                'password'         => Hash::make('y1Rqxzct7x4D0XmCex'),
                'active'           => 1,
                'created_user_id'  => 1,
                'updated_user_id'  => 1,
                'created_at'       => now(),
                'updated_at'       => now()
            ]
        ];

        foreach ($users as $user) {
            User::query()->create($user);
        }

        $this->info('All users has been created.');
    }
}
