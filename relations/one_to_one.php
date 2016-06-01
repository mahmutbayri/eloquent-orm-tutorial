<?php

namespace Relations;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

class User extends Model
{
    public $timestamps = false;

    public function phone()
    {
        return $this->hasOne(Phone::class);
    }
}

class Phone extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

###########################
User::truncate();
Phone::truncate();
###########################


$user = new User;
$user->name = 'mahmut bayri';
$user->email = 'mahmut.bayri@mynetgroup.com';
$user->save();

$phone = new Phone;
$phone->number = '0 212 254 56 56';
$user->phone()->save($phone);

dump($user->phone()->getResults()->toArray());