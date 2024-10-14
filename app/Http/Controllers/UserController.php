<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create()
    {
        $users = [
            [
                'name' => 'Name0',
                'email' => 'Email0',
                'password' => bcrypt(Str::random(10)),
            ],
            [
                'name' => 'Name1',
                'email' => 'Email1',
                'password' => bcrypt(Str::random(10)),
            ],
            [
                'name' => 'Name2',
                'email' => 'Email2',
                'password' => bcrypt(Str::random(10)),
            ],
            [
                'name' => 'Name3',
                'email' => 'Email3',
                'password' => bcrypt(Str::random(10)),
            ],
            [
                'name' => 'Name4',
                'email' => 'Email4',
                'password' => bcrypt(Str::random(10)),
            ]
        ];

        foreach($users as $user)
        {
            User::create($user);
        }

        // insert se tra ve true nhung ko fill timestamp - dung duoc cho ca 1 array data
        // create tra ve model va autofill timestamp - dung cho mot object duy nhat

        // User::insert([
        // [1],[2],[3],
        // ]);

        $insertedUser = User::all();
        if($insertedUser)
        {
            return true;
        }

        return false;
    }

    public function getName()
    {
        $usersName = User::all()->pluck('name');

        dd($usersName);
    }

    public function updateEmail()
    {
        $id = 3;

        User::where('id',$id)->update([
            'email' => 'Updated email'
        ]);

        return true;
    }

    public function deleteUser()
    {
        $id = 5;

        $user = User::find($id);
        $user->delete();

        return true;
    }

    public function getUserHas2Posts()
    {
        $users = User::has('posts','>=',2)->get();

        dd($users);
    }

    public function getPostsCount()
    {
        $count = User::withCount('posts')->pluck('posts_count');

        dd($count);
    }
}
