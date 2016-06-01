<?php

namespace Relations;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

/**
 * @property $name
 */
class User extends Model
{
    public $timestamps = false;

    public function permissions()
    {
        return $this->morphOne(Permission::class, 'permissible');
    }
}

//class Role extends Model
//{
//    public $timestamps = false;
//
//    public function permissions()
//    {
//        return $this->morphMany(Permission::class, 'permissible');
//    }
//}

class Permission extends Model
{
    public $timestamps = false;
    protected $fillable = ['value'];

    public function permissible()
    {
        return $this->morphTo();
    }
}

###########################
// http://jordijoan.me/using-polymorphic-relations-laravel/
User::truncate();
//Role::truncate();
Permission::truncate();
###########################

$user = new User;
$user->name = 'mahmut bayri';
$user->email = 'mahmut.bayri@mynetgroup.com';
$user->save();

/*
$permisson = new Permission;
$user->permissions()->save($permisson);
*/
$user->permissions()->create([
    'value' => 'ana-sayfa-edit, kullanici-ekle',
]);

//$user->permissions->value = 988;
//$user->push();

//dump(get_class_methods($user->permissions));

//$user->permissions()->updateOrCreate(['value' => 155]);

dump($user->permissions()->getResults()->toArray());
//var_dump($user->permissions()->getResults()->toArray());

//$permision = Permission::find(1);
//var_dump($permision->permissible()->getResults());
//object(Relations\Permission)

//dump(Permission::all()->toArray());
//dump(Permission::find(1)->permissible->toArray());
