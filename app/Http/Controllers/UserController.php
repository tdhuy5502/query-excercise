<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create()
    {
        // non loop query
        User::insert([
            [
                'name' => 'Name0',
                'email' => 'Email0',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Name1',
                'email' => 'Email1',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Name2',
                'email' => 'Email2',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Name3',
                'email' => 'Email3',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Name4',
                'email' => 'Email4',
                'password' => Hash::make('password')
            ]
        ]);

        // insert se tra ve true nhung ko fill timestamp - dung duoc cho ca 1 array data
        // create tra ve model va autofill timestamp - dung cho mot object duy nhat

        // User::insert([
        // [1],[2],[3],
        // ]);

        return true;
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
        $users = User::has('posts','>=',3)->get();

        dd($users);
    }

    public function getPostsCount()
    {
        $count = User::withCount('posts')->pluck('posts_count');

        dd($count);
    }
}
