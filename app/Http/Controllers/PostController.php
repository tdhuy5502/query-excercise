<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create()
    { 
        //
        $users = User::all();
        $post_data=[];

        foreach($users as $user)
        {
            for($i = 0; $i < 3 ; $i++)
            {
                $post_data[] = [
                    'title' => 'Title ' . $i, 
                    'Content' => 'Content ' . $i,
                    'user_id' => $user->id
                ];
            }
        }

        $posts = Post::insert($post_data);
        dd($posts);
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
        $posts = Post::with('user')->where('user_id',5)->delete();

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

    public function addTags()
    {
        $tagName = [
            ['name' => 'Tag 1'],
            ['name' => 'Tag 2'],
            ['name' => 'Tag 3']
        ];
        Tag::insert($tagName);

        $tagIds = Tag::all()->pluck('id');

        $posts = Post::all();

        foreach($posts as $post)
        {
            $post->tags()->attach($tagIds);
        }

        return true;
    }

    public function getTags()
    {
        $post = Post::find(1);

        $tags = $post->tags;

        dd($tags);
    }

    public function getByTagName()
    {
        $posts = Post::whereHas('tags', function($query){
            $query->where('name','Eloquent');
        })->get(); 

        dd($posts);
    }

    public function postWithCondition()
    {
        $posts = Post::whereHas('comments',function($cmtQuery){
            $cmtQuery->havingRaw('COUNT(*) > 5')
            ->whereHas('user',function($userQuery){
                $userQuery->where('email','LIKE','%.@example.com');
            });
        })->get();

        dd($posts);
    }

    public function postNow()
    {
        $posts = Post::createdThisMonth()->get();

        dd($posts);
    }

    public function userPostNow()
    {
        $posts = Post::where('user_id',1)->createdThisMonth()->get();

        dd($posts);
    }
}
