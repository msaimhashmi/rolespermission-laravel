<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::create([
        //     'name' => 'Admin', 
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345678')
        // ]);
    
        // $role = Role::create(['name' => 'Admin', 'slug' => Str::slug('slug')]);
     
        // $permissions = Permission::pluck('id','id')->all();
   
        // $role->permissions()->attach($permissions);
     
        // $user->assignRole([$role->id]);
    }
}
