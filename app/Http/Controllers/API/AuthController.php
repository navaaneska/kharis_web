<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $user = User::where('username', $request->username)->first();
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            $user = User::where('email', $request->username)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'UNAUTHORIZED'
            ], 401);
        }


        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil LogOut'
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            "email" => 'required|email',
            "alamat" => 'required',
            "whatsapp" => 'required|numeric',
            "pekerjaan" => 'required',
            "jenis_kelamin" => 'required',
            "tanggal_lahir" => 'required|date'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->whatsapp = $request->whatsapp;
        $user->pekerjaan = $request->pekerjaan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->save();

        return response()->json([
            'message'       => 'Data Customer Berhasil Ditambahkan',
            'user' => $user,
        ], 200);
    }
}
