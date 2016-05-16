<?php

namespace Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

class User extends Model
{
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('age', function(Builder $builder){
            $builder->where('age', '>', 200);
        });
    }

}

###########################
User::truncate();
###########################

$user1 = new User;
$user1->name = 'mahmut bayri';
$user1->email = 'mahmut.bayri@mynetgroup.com';
$user1->save();
