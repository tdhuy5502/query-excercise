<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create()
    {
        $users = User::all();

        foreach($users as $user)
        {
            for($i = 0; $i < 3 ; $i++)
            {
                $user->posts()->create([
                    'title' => 'Title' . $i,
                    'content' => 'Content' .$i,
                ]);
            }
        }

        return true;
    }

    public function findPostById()
    {
        $posts = Post::with('user')->where('user_id',1)->get();

        dd($posts);
    }

    public function updateById()
    {
        $post = Post::where('id',2)->update([
            'title' => 'New Title Update',
        ]);

        dd($post);
    }

    public function delete()
    {
        $posts = Post::with('user')->where('user_id',5)->get();

        foreach($posts as $post)
        {
            $post->delete();
        }

        return true;
    }

    public function createById()
    {
        $id = 2;
        $user = User::find($id);


        $user->posts()->create(
            [
                'title' => 'Title for user 2',
                'content' => 'Content for user 2'
            ]
        );

        return true;
    }

    public function getPostHasTitle()
    {
        $posts = Post::where('title','LIKE','%Laravel%')->get();

        dd($posts);
    }

    
}
