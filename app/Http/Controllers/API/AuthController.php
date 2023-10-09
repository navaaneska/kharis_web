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
        $user = User::with('pasangan')->where('username', $request->username)->first();
        // $user = User::with('ayah', 'ibu', 'pasangan')->where('username', $request->username)->first();
        if (!$user) {
            $user = User::with('pasangan')->where('email', $request->username)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'UNAUTHORIZED'
            ], 401);
        }


        $findOrangTua = User::where('id', $user->ayah_id)->orWhere('id', $user->ibu_id)->get();

        // Find Eyang
        $findEyang = [];
        for ($i = 0; $i < count($findOrangTua); $i++) {
            if ($findOrangTua[$i]) {
                $findKakek = $findOrangTua[$i]::where('id', $findOrangTua[$i]->ayah_id)->first();
                $findNenek = $findOrangTua[$i]::where('id', $findOrangTua[$i]->ibu_id)->first();
                if ($findKakek) {
                    array_push($findEyang, $findOrangTua[$i]::where('id', $findOrangTua[$i]->ayah_id)->first());
                }
                if ($findNenek) {
                    array_push($findEyang, $findOrangTua[$i]::where('id', $findOrangTua[$i]->ibu_id)->first());
                }
            }
        }

        $findAnak = User::where('ayah_id', $user->id)->orWhere('ibu_id', $user->id)->get();
        $findSaudara = User::where('ayah_id', $user->ayah_id)->orWhere('ibu_id', $user->ibu_id)->get();

        // Find Paman
        $getIdEyang = [];
        for ($i = 0; $i < count($findEyang); $i++) {
            if ($findEyang[$i]) {
                array_push($getIdEyang, $findEyang[$i]->id);
            }
        }
        $findPaman = User::whereIn('ayah_id', $getIdEyang)->orWhereIn('ibu_id', $getIdEyang)->get();

        // Find Cucu
        $getIdPaman = [];
        for ($i = 0; $i < count($findPaman); $i++) {
            if ($findPaman[$i]) {
                array_push($getIdPaman, $findPaman[$i]->id);
            }
        }
        $findCucu = User::whereIn('ayah_id', $getIdPaman)->orWhereIn('ibu_id', $getIdPaman)->get();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token,
            'eyang' => $findEyang,
            'orangtua' => $findOrangTua,
            'anak' => $findAnak,
            'saudara' => $findSaudara,
            'paman' => $findPaman,
            'cucu' => $findCucu
        ], 200);
    }

    public function checkGoogleLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
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
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message'       => 'Data Customer Berhasil Ditambahkan',
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
