<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTimestamp = DB::raw("CURRENT_TIMESTAMP");

        // TODO: Add holding
        // Holding
        // $holdings = [
        //     [
        //         "name"        => "Holding Name",
        //         "description" => null,
        //         "created_at"  => $currentTimestamp,
        //         "updated_at"  => $currentTimestamp,
        //     ],
        // ];
        // DB::table("holdings")->insert($holdings);

        // Role
        $roles = array_map(function ($data) use ($currentTimestamp) {
            return array_merge($data, [
                "created_at" => $currentTimestamp,
                "updated_at" => $currentTimestamp,
            ]);
        }, array_values(config("enums.roles")));
        DB::table("roles")->insert($roles);

        // Super Admin
        $users = [
            [
                // "holding_id"        => null,
                "name"              => "Super Admin",
                "email"             => "super@admin.com",
                "password"          => bcrypt("123456"),
                "is_active"         => true,
                "email_verified_at" => $currentTimestamp,
                "created_at"        => $currentTimestamp,
                "updated_at"        => $currentTimestamp,
            ],
        ];
        DB::table("users")->insert($users);

        // Super Admin Role
        $userRoles = [
            [
                "model_type" => "App\Models\User",
                "role_id"    => config("enums.roles.SUPER_ADMIN.id"),
                "model_id"   => 1
            ],
        ];
        DB::table("model_has_roles")->insert($userRoles);
    }
}
