<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    //request oluşturmadan , unique sorgu

    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password'])
        ]);

        $token = $user->createToken('utoken')->plainTextToken;

        $response = [
            'user'=> $user,
            'token'=>$token
        ];

        //201 for create

        return response($response,201);
    }
}
