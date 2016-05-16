<?php

namespace Relations;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

class Service extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}

class User extends Model
{
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

class Post extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

###########################
Service::truncate();
User::truncate();
Post::truncate();
###########################

$service = new Service;
$service->name = 'service name';
$service->save();

$user = new User;
$user->name = 'mahmut bayri';
$user->email = 'mahmut.bayri@mynetgroup.com';
$user->service_id = 1;
$user->save();

$post = new Post;
$post->title = 'post title';

$user->posts()->save($post);

dump($service->posts()->getResults()->toArray());