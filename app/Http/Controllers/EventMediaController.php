<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = EventMedia::all();

        // dd($medias);

        return view('event_media.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        $categories = ['image', 'youtube', 'spotify'];
        $utamas = ['utama', 'tidak'];

        return view('event_media.create', compact('categories', 'events', 'utamas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // dd($request->file('file'));

        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka',
            // 'image' => 'Isi :atribute dengan foto'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'judul' => 'required',
            // 'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis' => 'required',
            'utama' => 'required',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // get Image
        $file = $request->file('file');

        if ($file != null) {
            $encryptFileName = $file->hashName();

            // file Store
            $file->store('public/files/event-media');
        }

        $eventMedia = new EventMedia;
        $eventMedia->event_id = $request->nama;
        $eventMedia->judul = $request->judul;

        if ($file != null) {
            $eventMedia->file = $encryptFileName;
        }
        $eventMedia->jenis = $request->jenis;
        if ($request->utama == 'utama') {
            $eventMedia->utama = 1;
        } else {
            $eventMedia->utama = 0;
        }


        $eventMedia->save();

        return redirect()->route('events-media.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $eventMedia = EventMedia::find($id);

        $file = 'public/files/event-media' . $eventMedia->file;

        return view('event_media.show', compact('eventMedia', 'file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $eventMedia = EventMedia::find($id);
        $events = Event::all();
        $categories = ['image', 'youtube', 'spotify'];
        $utamas = ['utama', 'tidak'];

        if ($eventMedia->utama == 0) {
            $getUtama = 'tidak';
        } else {
            $getUtama = 'utama';
        }


        return view('event_media.edit', compact('eventMedia', 'utamas', 'categories', 'getUtama', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka',
            // 'image' => 'Isi :atribute dengan foto'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'judul' => 'required',
            // 'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis' => 'required',
            'utama' => 'required',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // get Image
        $file = $request->file('file');

        if ($file != null) {
            $encryptFileName = $file->hashName();

            // file Store
            $file->store('public/files/event-media');
        }

        $eventMedia = EventMedia::find($id);
        $eventMedia->event_id = $request->nama;
        $eventMedia->judul = $request->judul;
        if ($file != null) {
            $eventMedia->file = $encryptFileName;
        }
        $eventMedia->jenis = $request->jenis;
        if ($request->utama == 'utama') {
            $eventMedia->utama = 1;
        } else {
            $eventMedia->utama = 0;
        }


        $eventMedia->save();
        return redirect()->route('events-media.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
