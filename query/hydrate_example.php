<?php

namespace Query;
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

$user1 = new User;
$user1->name = 'mahmut bayri';
$user1->email = 'mahmut.bayri@mynetgroup.com';
$user1->save();

$role = new Role;
$role->name = 'Admin';
$role->save();

$user1->roles()->sync([$role->id]);

dump(User::all()->toArray());

dump($user1->roles()->getResults()->toArray());


/** @var \Illuminate\Database\Query\Builder $query */
/** @var \Illuminate\Database\Query\Builder $rawQ */
//$query = $manager->connection()->query();
//$rawQ = $query->from('users')->select($query->raw("(CASE WHEN (service_id = 1) THEN 'A' ELSE 'B' END) AS gender_text, users.*"))->where('name', 'LIKE', '%mahmut%');
//dd($rawQ->getBindings());
//$example = User::hydrateRaw($rawQ->toSql(), $rawQ->getBindings());

//http://stackoverflow.com/questions/27863956/laravel-how-do-you-select-where-like
$user1 = User::hydrateRaw(
    "SELECT (CASE WHEN (service_id = 1) THEN 'A' ELSE 'B' END) AS gender_text, users.* FROM users WHERE name LIKE :name",
    ["name" => '%mahmut%']
)->first();

dump($user1->roles()->getResults()->toArray());

