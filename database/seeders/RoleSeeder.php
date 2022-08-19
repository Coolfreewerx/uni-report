<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::first();
        if (!$role) {
            $this->command->line("Generating Roles");
            $roles = ['admin', 'student', 'employee', 'teacher'];
            
            collect($roles)->each(function ($role_name, $key) {
                $role = new Role();
                $role->name = $role_name;
                $role->save();
        });
    }
}
