<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::create([
        //     'name' => 'Bulut Kuru',
        //     'email' => 'bulut.kuru@ibb.gov.tr',
        //     'password' => Hash::make('144652qwe')
        // ]);
        $user = User::find(1);
        $role = Role::find(1);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->syncRoles(['1']);
    }
}
