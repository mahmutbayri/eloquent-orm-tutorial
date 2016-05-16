<?php

namespace Relations;
use Illuminate\Database\Eloquent\Model;

require __DIR__ . '/../init.php';

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

###########################
User::truncate();
Post::truncate();
###########################

$user = new User;
$user->name = 'mahmut bayri';
$user->email = 'mahmut.bayri@mynetgroup.com';

$user->save();

$post = new Post;
$post->title = '0 212 254 56 56';

$user->posts()->save($post);

dump($user->posts()->getResults());