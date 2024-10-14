<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function create()
    {
        $posts = Post::all();
        $data = [];

        foreach($posts as $post)
        {
            for($i = 0 ; $i < 2 ; $i++)
            {
                $data[] = [
                    'content' => 'Content ' . $i,
                    'user_id' => $post->user->id,
                    'post_id' => $post->id
                ]; 
            }
        }

        $comments = Comments::insert($data);
    }

    public function getById()
    {
        $comments = Comments::where('post_id',1)->get();

        dd($comments);
    }

    public function updateById()
    {
        $comment = Comments::where('id',3)->update([
            'content' => 'Updated content at id = 3'
        ]);

        dd($comment);
    }

    public function deleteByUserId()
    {
        $comment = Comments::where('user_id',2)->delete();

        dd($comment);
    }
}
