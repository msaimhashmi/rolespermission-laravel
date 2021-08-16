<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use App\User;
use App\Form;
use Auth;

class PermissionController extends Controller
{
	public function __construct()
	{
	   $this->middleware('auth'); 
	}

	public function permissionIndex()
	{
		if(Auth::user()->can('permissions-crud'))
		{
			$permissions = Permission::get();
			return view('admin.permission.index')->with(compact('permissions'));
		}
		return "you dont have permission";
	}

	public function permissionStore(Request $request)
	{
		// $saim = $request->user()->permissions();
		if ($request->user()->can('tasks-crud')) {

			$permission = new Permission();
			$permission->name = $request->name;
			$permission->slug = \Str::slug($request->name);
			$permission->save();

			return redirect()->to(route('permission.index'))->with('message', 'Record created successfully!');
    	}

    	return "You dont have permission";
	}

	public function permissionDelete($id)
	{
		$permission = Permission::find($id);
		$permission->delete();

		return redirect()->back()->with('message', 'Record deleted successfully!');
	}

	public function roleIndex()
	{
		$roles = Role::get();
		$permissions = Permission::get();
		return view('admin.role.index')->with(compact('roles', 'permissions'));
	}

	public function roleStore(Request $request)
	{
		$role = new Role();
		$role->name = $request->name;
		$role->slug = \Str::slug($request->name);
		$role->save();
		$role->permissions()->attach($request->permission);

		return redirect()->to(route('role.index'))->with('message', 'Record created successfully!');
	}

    public function Permissions()
    {   
    	$dev_permission = Permission::where('slug','create-tasks')->first();
		$manager_permission = Permission::where('slug', 'edit-users')->first();

		//RoleTableSeeder.php
		$dev_role = new Role();
		$dev_role->slug = 'developer';
		$dev_role->name = 'Front-end Developer';
		$dev_role->save();
		$dev_role->permissions()->attach($dev_permission);

		$manager_role = new Role();
		$manager_role->slug = 'manager';
		$manager_role->name = 'Assistant Manager';
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($dev_role);

		$createTasks = new Permission();
		$createTasks->slug = 'delete-tasks';
		$createTasks->name = 'Delete Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($manager_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$dev_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();

		$developer = new User();
		$developer->name = 'Admin';
		$developer->email = 'admin@gmail.com';
		$developer->password = bcrypt('12345678');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$developer = new User();
		$developer->name = 'M Saim Hashmii';
		$developer->email = 'saimhashmii433@gmail.com';
		$developer->password = bcrypt('12345678');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new User();
		$manager->name = 'M Mohtashim Hashmii';
		$manager->email = 'mohtashim@gmail.com';
		$manager->password = bcrypt('12345678');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		return redirect()->back();
    }

    public function form(Request $request)
    {
    	if ($request->user()->can('create-tasks')) 
    	{
        	Form::create($request->all());
        	return "Submit successfully!";
    	}
    	return "you havn't permission to create task!";
    }
}
