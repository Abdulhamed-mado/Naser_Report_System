<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class rolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::create(['name' => 'fullAccessUser']);
        $thirdpermission = Permission::create(['name' => 'taskReport']);
        $fifthpermission = Permission::create(['name' => 'fullAccessplayers']);
        $sixthpermission = Permission::create(['name' => 'fullreportplayers']);
        $seventhpermission = Permission::create(['name' => 'createPlan']);
        $eigthpermission = Permission::create(['name' => 'fullAccessplan']);
        $ninthpermission = Permission::create(['name' => 'seereportplayers']);
        $tenthpermission = Permission::create(['name' => 'seeAccessplayers']);


        $Firstrole = Role::create(['name' => 'superadmin']);
        $Firstrole->givePermissionTo('fullAccessUser');
        $Firstrole->givePermissionTo('taskReport');
        $Firstrole->givePermissionTo('fullreportplayers');
        $Firstrole->givePermissionTo('fullAccessplayers');
        $Firstrole->givePermissionTo('fullAccessplan');
        $Firstrole->givePermissionTo('createPlan');
        $Firstrole->givePermissionTo('seereportplayers');
        $Firstrole->givePermissionTo('seeAccessplayers');

        $Secondrole = Role::create(['name' => 'مدرب']);
        $Secondrole->givePermissionTo('taskReport');
        $Secondrole->givePermissionTo('createPlan');
        $Secondrole->givePermissionTo('seereportplayers');
        $Secondrole->givePermissionTo('seeAccessplayers');


        $Thirdrole = Role::create(['name' => 'اداري']);
        $Thirdrole->givePermissionTo('taskReport');
        $Thirdrole->givePermissionTo('fullAccessplayers');
        $Thirdrole->givePermissionTo('fullreportplayers');
    $Thirdrole->givePermissionTo('seereportplayers');
        $Thirdrole->givePermissionTo('seeAccessplayers');

    }
}