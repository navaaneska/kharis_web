<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventPeserta;
use App\Models\EventPesertaPresensi;
use App\Models\EventQrcode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class EventPesertaPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengecek Qrcode
        $getQrCode = EventQrcode::where('qr', $request->qrcode)->first();
        // $user = DB::table('personal_access_tokens')->where('token', $request->token)->value('tokenable_id');\
        // dd($getQrCode->event->nama);

        // CheckToken
        $token = PersonalAccessToken::findToken($request->token);
        $user = $token->tokenable;
        // dd($user->id);

        // $user = Token::find($token_id)->user;

        if ($getQrCode) {

            // Mengecek Event
            $checkEventPeserta = EventPeserta::where('event_id', $getQrCode->event_id)->where('user_id', $user->id)->first();
            if ($checkEventPeserta) {

                // Mengecek Kehadiran
                $checkKehadiran = EventPesertaPresensi::where('qrcode_id', $getQrCode->id)->where('user_id', $user->id)->first();
                if ($checkKehadiran) {

                    return response()->json([
                        'message'       => 'Anda sudah melakukan absen sebelumnya',
                    ], 200);
                } else {
                    $eventPesertaPresensi = new EventPesertaPresensi;
                    $eventPesertaPresensi->qrcode_id = $getQrCode->id;
                    $eventPesertaPresensi->user_id = $user->id;
                    $eventPesertaPresensi->jam_presensi = Carbon::now();
                    $eventPesertaPresensi->save();
                    $getEvent = $getQrCode->event->nama;

                    return response()->json([
                        'message'       => "Berhasil melakukan presensi $getQrCode->judul, pada event $getEvent",
                    ], 200);
                }
            } else {
                return response()->json([
                    'message'       => 'Peserta tidak terdaftar pada event ini',
                ], 200);
            }
        } else {
            return response()->json([
                'message'       => 'qrcode tidak valid',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
