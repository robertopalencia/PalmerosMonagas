<?php

use Illuminate\Database\Seeder;
use Palma\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role ->description = 'Administrator';
        $role->save();
        $role = new Role();
        $role->name = 'user';
        $role->description='User';
        $role->save();
        $role = new Role();
        $role->name = 'watcher';
        $role->description='Observador';
        $role->save();
    }
}
