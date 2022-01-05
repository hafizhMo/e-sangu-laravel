<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function login(Request $request) 
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password))
        {
            return response([
                'error' => true,
                'message' => 'These credentials do not matches our records.',
                'user' => null,
                'token' => null
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'error' => false,
            'message' => 'Login successfully!',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    function register(Request $request) 
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return [
                'error' => true,
                'message' => 'Email already exists!',
                'user'=> null,
                'token'=> null
            ];
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role,
            'password'=>Hash::make($request->password)
        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;

        $response=[
            'error' => false,
            'message' => 'Registered successfully!',
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);

    }

    public function show($id)
    {
        $user = User::find($id);

        if (!empty($user)) {
            $response = [
                'error' => false,
                'message' => 'Data load successfully',
                'user' => $user
            ];
            
        } else {
            $response = [
                'error' => true,
                'message' => 'Data not found',
                'user' => null
            ];
        }
        
        return response($response);
    }
}
