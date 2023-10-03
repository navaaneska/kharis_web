<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventQrcode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventQrCodeController extends Controller
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
        // $pageTitle = 'Event';


        // return view('event_qrcode.create', compact('pageTitle'));
    }
    public function createNew(string $id)
    {
        $pageTitle = 'Event';

        $event = Event::find($id);
        return view('event_qrcode.create', compact('pageTitle', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => 'required',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $generateQr = Str::random(40);
        $event_qrcode = new EventQrcode;
        $event_qrcode->judul = $request->judul;
        $event_qrcode->event_id = $request->nama;
        $event_qrcode->qr = $generateQr;
        $event_qrcode->save();

        return redirect()->route('events-qrcode.show', ['events_qrcode' => $request->nama]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Event';
        $getEventQrCodes = EventQrcode::all();
        $eventQrCodes = $getEventQrCodes->where('event_id', $id);
        $event = Event::find($id);

        return view('event_qrcode.show', compact('pageTitle', 'eventQrCodes', 'event'));
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
