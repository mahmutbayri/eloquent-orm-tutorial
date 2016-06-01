<?php

namespace Relations;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

class Service extends Model
{
    public $timestamps = false;

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
}

class Post extends Model
{
    public $timestamps = false;
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
$post->body = 'post body';

$user->posts()->save($post);

dump($service->posts()->getResults()->toArray());
//var_dump($post->user->service()->getResults()->toArray());