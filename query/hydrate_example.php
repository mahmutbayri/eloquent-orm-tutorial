<?php

namespace Query;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

class User extends Model
{
    public $timestamps = false;

    public function zz()
    {
        return 'gelir';
    }
}


###########################
User::truncate();
###########################

$user1 = new User;
$user1->name = 'mahmut bayri';
$user1->email = 'mahmut.bayri@mynetgroup.com';
$user1->service_id = 1;
$user1->save();

//dump(User::all()->toArray());

//dump($user1->roles()->getResults()->toArray());


/** @var \Illuminate\Database\Query\Builder $query */
/** @var \Illuminate\Database\Query\Builder $rawQ */
$query = $manager->connection()->query();

//$rawQ = $query->from('users')->select($query->raw("(CASE WHEN (service_id = 1) THEN 'A' ELSE 'B' END) AS gender_text, users.*"))->where('name', 'LIKE', '%mahmut%');
//$user1 = User::hydrateRaw($rawQ->toSql(), $rawQ->getBindings())


//$user1 = User::hydrateRaw(
//    "SELECT
//      (CASE WHEN (service_id = 1) THEN 'A' ELSE 'B' END) AS gender_text,
//      users.*
//    FROM users
//    WHERE name
//    LIKE :name",
//    ['name' => '%mahmut%']
//)->first();

//yeni kayıt oluşturmaz
/** @var User $user2 */
$user2 = User::hydrate(
    [
        [
            'name' => 'mahmut------------',
            'email' => 'mahmut.bayri@mynetgroup.com',
        ]
    ]
)->first();

//$results = $query->select("SELECT * FROM users")->get();

//http://stackoverflow.com/questions/27863956/laravel-how-do-you-select-where-like
//$user1 = User::hydrateRaw(
//    "SELECT (CASE WHEN (service_id = 1) THEN 'A' ELSE 'B' END) AS gender_text, users.* FROM users WHERE name LIKE :name",
//    ["name" => '%mahmut%']
//);

dump($user2->zz());

$user2->touch();

dump(User::all()->toArray());

//dump($user1->toArray());

