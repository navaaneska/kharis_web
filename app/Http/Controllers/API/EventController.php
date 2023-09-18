<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Event_Categorie;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('event_categorie', 'event_categorie2')->get();

        // $events = Event_Categorie::with('event')->get();

        return response()->json([
            'events' => $events,
        ], 200);
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

    public function event_detail(string $id)
    {
        // $get_event_detail = Event::find($id);
        $event_detail = Event::with('event_media', 'event_pengisi_acara', 'event_categorie', 'event_categorie2')->get()->find($id);
        // $event_detail = $get_event_detail::;


        // $events = Event_Categorie::with('event')->get();


        return response()->json([
            'event_detail' => $event_detail,
        ], 200);
    }
}
