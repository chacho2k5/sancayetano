<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleInvitado = Role::create(['name' => 'invitado']);

        Permission::create(['name' => 'view:role']);
        Permission::create(['name' => 'create:role']);
        Permission::create(['name' => 'edit:role']);
        Permission::create(['name' => 'delete:role']);

        Permission::create(['name' => 'view:permiso']);

        Permission::create(['name' => 'view:usuario']);
        Permission::create(['name' => 'create:usuario']);
        Permission::create(['name' => 'edit:usuario']);
        Permission::create(['name' => 'delete:usuario']);

        $user = new User;
        $user-> name = "admin";
        $user-> email = "admin@gmail.com";
        $user-> password = bcrypt('98765432');
        $user->save();
        $user->assignRole($roleAdmin);

        $user = new User;
        $user-> name = "invitado";
        $user-> email = "invitado@gmail.com";
        $user-> password = bcrypt('98765432');
        $user->save();
        $user->assignRole($roleInvitado);
    }
}
