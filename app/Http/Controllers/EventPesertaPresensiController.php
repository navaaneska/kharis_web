<?php

namespace App\Http\Controllers;

use App\Models\EventPesertaPresensi;
use App\Models\EventQrcode;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $pageTitle = 'Event';
        $qrCode = EventQrcode::find($id);
        $getPesertaPresensi = EventPesertaPresensi::all();
        $pesertaPresensis = $getPesertaPresensi->where('qrcode_id', $id);


        return view('event_peserta_presensi.show', compact('pageTitle', 'pesertaPresensis', 'qrCode'));
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
