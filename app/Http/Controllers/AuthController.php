<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function create(Request $request){
        
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'lastname' => 'required|string|max:100',
        ];

        $validator = Validator::make($request->input(),$rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lastname' => $request->lastname,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario Creado',
            'token' => $user->createToken('API TOKEN')->plainTextToken

        ],200);
    }
    public function login(Request $request){

        $rules = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->input(),$rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => false,
                'errors' => 'Usuario no Autorizado'

            ],401);
        }

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Usuario Logueado correctamente',
            'data' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }

    public function regenerateUser(Request $request)
    {
        // Verificar si el usuario tiene un token válido
        if ($request->user()) {
            // Obtener el usuario autenticado
            $user = $request->user();

            // Generar un nuevo token para el usuario
            $token = $user->createToken('API TOKEN')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Usuario Regenerado Correctamente',
                'data' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Usuario no REGENERADO'
        ], 401);
    }
    public function logout()
    {
        if (auth()->check()) {
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
    
            return response()->json([
                'status' => true,
                'message' => 'Usuario deslogueado Correctamente'
            ], 200);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'User not authenticated'
        ], 401);
    }
}
