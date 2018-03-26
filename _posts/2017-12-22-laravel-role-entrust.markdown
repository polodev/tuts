---
title: laravel-role-entrust
layout: post
---

# ENTRUST : Role-based Permissions for Laravel 5
### showing all roles inside admin
~~~html
{% raw %}
@forelse($roles as $role)
@empty
@endforelse
{% endraw %}
~~~

### adding permission to role

~~~html
{% raw %}
@foreach($permissions as $permission) 
<div>
  <input type="checkbox" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}
</div>
@endforeach
{% endraw %}
~~~


### inserting a row in role table without destructing `$request`. and attach permission to it
Role name, Display name, description    
~~~php
$role = Role::create($request->except(['permission', '_token']));
foreach($request->permission as $key => $value) {
  $role->attachPermission($value);
}

~~~


### edit permission

in controller
~~~php
$role = Role::find($id);
$permissions = Permission::all();
$role_permission = $role->perms->pluck('id', 'id')->toArray();
~~~
in blade file

~~~html
{% raw %}
@foreach($permissions as $permisson)
<input
  value={{$permission->id}}
  type="checkbox" {{ in_array($permission->id, $role_permission) ? 'checked': ''}}> 
  {{$permission->name}}
@endforeach
{% endraw %}
~~~

### method field for update

~~~php
{% raw %}
method_field('PATCH');
{% endraw %}
~~~

### update permission 

in controller
~~~php
$role = Role::find($id);
$role->name = $request->input('name');
$role->description = $request->input('description');
$role->display_name = $request->input('display_name');
DB::table('permission_role')->where("role_id", $id)->delete();
foreach($request->permission as $key => $value) {
  $role->attachPermission($value);
}
~~~


### assign roles to user
Inside Register controller create method
~~~php
$user = User::create([]);
$role = Role::where('name', 'admin')->first();
$user->attachRole($role);
return $user;
~~~


# Control features according roles

~~~php
public function __construct () {
  $this->middleware('role:admin')->only('create');
}
~~~


### edit user and assign multiple roles

inside blade
~~~html
{% raw %}
<select name="roles[]" multiple id="">
@foreach($all_roles as $role) 
  <option value="{{$role->id}}">{{$role->name}}</option>
@endforeach
</select>

<!-- for making unique form and modal we will user id as suffix -->
onclick="$('#role-form-{{$user->id}}').submit()"

{% endraw %}
~~~

Inside controller 
~~~php
$user = User::find($id);
$roles = $request->input('roles');
DB::table('role_user')->where('user_id', $id)->delete();
foreach($roles as $role) {
  $user->attachRole($role);
}



~~~












