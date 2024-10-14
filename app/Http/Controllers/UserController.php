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
                'name' => 'Name011',
                'email' => 'Email123',
                'password' => '12345678'
            ],
            [
                'name' => 'Name111',
                'email' => 'Email1131231',
                'password' => '12345678'
            ],
            [
                'name' => 'Name211',
                'email' => 'Email2123123',
                'password' => '12345678'
            ],
            [
                'name' => 'Name113',
                'email' => 'Email32222',
                'password' => '12345678'
            ],
            [
                'name' => 'Name114',
                'email' => 'Email42131231',
                'password' => '12345678'
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

    public function userWithCondition()
    {
        $users  = User::whereHas('posts',function($postQuery){
            $postQuery->where('content','LIKE','%PHP%')
            ->whereHas('comments',function($cmtQuery){
                $cmtQuery->havingRaw('COUNT(*) >= 2');
            });
        })->get();

        dd($users);
    }

    public function createWithMutator()
    {
        $user = new User();
        $user->name = 'Mutator';
        $user->email = 'mail.@example.com';
        $user->password = '12345678';
        $user->save();

        dd($user);
    }
}
