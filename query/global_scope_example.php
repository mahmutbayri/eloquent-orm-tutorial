<?php

namespace Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

require __DIR__ . '/../init.php';

class Scope implements ScopeInterface
{

    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('email', 'mahmut.bayri@mynetgroup.com');
    }

    public function remove(Builder $builder, Model $model)
    {
        // TODO: Implement remove() method.
    }
}

class User extends Model
{
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new Scope);
    }

}

###########################
User::truncate();
###########################

$user1 = new User;
$user1->name = 'mahmut bayri';
$user1->email = 'mahmut.bayri@mynetgroup.com';
$user1->save();

//dump($user1);

//it adds
$user1 = User::get();
