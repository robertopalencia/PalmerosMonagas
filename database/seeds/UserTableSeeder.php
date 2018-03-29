<?php

use Illuminate\Database\Seeder;
use Palma\Role;
use Palma\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role_user = Role::where('name', 'user')->first();
       $role_admin = Role::where('name', 'admin')->first();
       $role_watcher = Role::where('name', 'watcher')->first();
        
        $user = new User();
        $user->name='OscarPalencia';
        $user->email='monagaslibre@gmail.com';
        $user->password=bcrypt('Betty0406.');
        $user->save();
        $user->roles()->attach($role_admin);
        
    }
}
