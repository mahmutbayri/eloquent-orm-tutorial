<?php

namespace Relations;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

class User extends Model
{
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

class Role extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

###########################
User::truncate();
Role::truncate();
###########################

$user = new User;
$user->name = 'mahmut bayri';
$user->email = 'mahmut.bayri@mynetgroup.com';

$user->save();

$role = new Role;
$role->name = 'admin';
$user->roles()->save($role);

$role = new Role;
$role->name = 'editor';

$user->roles()->save($role);

dump($user->roles()->getResults()->toArray());
