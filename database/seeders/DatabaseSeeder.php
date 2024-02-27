<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sss;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Role::truncate();
        // Permission::truncate();
        // User::truncate();
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Sss::truncate();
        // Sss::factory(25)->create();
        // \App\Models\User::factory(7)->create();

        // $user = User::where('id', '!=', 1)->get();

        // foreach ($user as $user) {
        //     $user = User::find($user->id);
        //     $role = Role::find(2);
        //     $permissions = Permission::pluck('id', 'id')->all();
        //     $role->syncPermissions($permissions);
        //     $user->syncRoles(['2']);
        // }
    }
}
