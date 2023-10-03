<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventPeserta;
use App\Models\EventPesertaPresensi;
use App\Models\EventQrcode;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        if ($getQrCode) {

            // Mengecek Event
            $checkEventPeserta = EventPeserta::where('event_id', $getQrCode->event_id)->where('user_id', $request->user_id)->first();
            if ($checkEventPeserta) {

                // Mengecek Kehadiran
                $checkKehadiran = EventPesertaPresensi::where('qrcode_id', $getQrCode->id)->where('user_id', $request->user_id)->first();
                if ($checkKehadiran) {

                    return response()->json([
                        'message'       => 'Anda sudah melakukan absen sebelumnya',
                    ], 404);
                } else {
                    $eventPesertaPresensi = new EventPesertaPresensi;
                    $eventPesertaPresensi->qrcode_id = $getQrCode->id;
                    $eventPesertaPresensi->user_id = $request->user_id;
                    $eventPesertaPresensi->jam_presensi = Carbon::now();
                    $eventPesertaPresensi->save();

                    return response()->json([
                        'message'       => 'Berhasil melakukan presensi',
                    ], 200);
                }
            } else {
                return response()->json([
                    'message'       => 'Peserta tidak terdaftar pada event ini',
                ], 404);
            }
        } else {
            return response()->json([
                'message'       => 'qrcode tidak valid',
            ], 404);
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
