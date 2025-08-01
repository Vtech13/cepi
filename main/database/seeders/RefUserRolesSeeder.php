<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'          => 9,
                'name'        => 'Super admin',
                'shortname'   => 'SUAdmin',
                'description' => 'Dev of the system - can do all'
            ],
            [
                'id'          => 7,
                'name'        => 'Admin',
                'shortname'   => 'Admin',
                'description' => 'Owner of the system - can do all'
            ],
            [
                'id'          => 5,
                'name'        => 'Confrère',
                'shortname'   => 'Confrère',
                'description' => 'Can only see and download informations about patient than he can have access to.'
            ],
            [
                'id'          => 3,
                'name'        => 'AdminCMS',
                'shortname'   => 'AdminCMS',
                'description' => 'Admin CMS - change frontend text + photo + posts'
            ]
        ];

        DB::table('ref_user_roles')->delete();
        DB::table('ref_user_roles')->insert($data);
    }
}
