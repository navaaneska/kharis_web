<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMedia;
use DOMDocument;
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
        $pageTitle = "Media";
        $medias = EventMedia::all();
        // dd($medias);

        return view('event_media.index', compact('medias', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Media";
        $events = Event::all();
        $categories = ['image', 'youtube', 'spotify'];
        $utamas = ['utama', 'tidak'];


        return view('event_media.create', compact('categories', 'events', 'utamas', 'pageTitle'));
    }

    public function createNew(string $id)
    {
        $pageTitle = "Media";
        $event = Event::find($id);
        $categories = ['image', 'youtube', 'spotify'];
        $utamas = ['utama', 'tidak'];

        return view('event_media.create', compact('categories', 'event', 'utamas', 'pageTitle'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'deskripsi' => 'required',
            'utama' => 'required',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->jenis == 'image') {
            // get Image
            $file = $request->file('file');

            if ($file != null) {
                $encryptFileName = $file->hashName();

                // file Store
                $file->store('public/files/event-media');
            }
        } elseif ($request->jenis == 'youtube') {
            // get Link Youtube
            $get_link_youtube = explode("/", $request->link);
            // $link_youtube = $get_link_youtube[3];
            $link_youtube = end($get_link_youtube);

            // get thumbnail youtube
            $url = "https://www.youtube.com/live/" . $link_youtube;
            ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
            $get_thumbnail_youtube = get_meta_tags($url);
            $thumbnail_youtube = $get_thumbnail_youtube['twitter:image'];
        } elseif ($request->jenis == 'spotify') {
            // get Link Spotify
            $get_link_spotify = explode("/", $request->link);
            $link_spotify = $get_link_spotify[4];

            // get thumbnail Spotify
            $url = $request->link;
            ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
            $get_thumbnail_spotify = get_meta_tags($url);
            $thumbnail_spotify = $get_thumbnail_spotify['twitter:image'];
        }

        $eventMedia = new EventMedia;
        $eventMedia->event_id = $request->nama;
        $eventMedia->judul = $request->judul;
        if ($request->jenis == 'image') {
            if ($file != null) {
                $eventMedia->file = $encryptFileName;
            }
        } elseif ($request->jenis == 'youtube') {
            $eventMedia->file = $link_youtube;
            $eventMedia->thumbnail = $thumbnail_youtube;
        } elseif ($request->jenis == 'spotify') {
            $eventMedia->file = $link_spotify;
            $eventMedia->thumbnail = $thumbnail_spotify;
        }

        $eventMedia->jenis = $request->jenis;
        $eventMedia->deskripsi = $request->deskripsi;
        if ($request->utama == 'utama') {
            $eventMedia->utama = 1;
        } else {
            $eventMedia->utama = 0;
        }


        $eventMedia->save();

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = "Media";
        $eventMedia = EventMedia::find($id);


        $file = 'public/files/event-media' . $eventMedia->file;

        return view('event_media.show', compact('eventMedia', 'file', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = "Media";
        $eventMedia = EventMedia::find($id);
        $events = Event::all();
        $categories = ['image', 'youtube', 'spotify'];
        $utamas = ['utama', 'tidak'];

        if ($eventMedia->utama == 0) {
            $getUtama = 'tidak';
        } else {
            $getUtama = 'utama';
        }


        return view('event_media.edit', compact('eventMedia', 'utamas', 'categories', 'getUtama', 'events', 'pageTitle'));
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
            'deskripsi' => 'required',
            'utama' => 'required',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $check_jenis = EventMedia::find($id);
        // dd($check_jenis->jenis);

        if ($check_jenis->jenis == 'image') {
            if ($request->jenis == 'image') {

                // get Image
                $file = $request->file('file');

                if ($file != null) {
                    $media = EventMedia::find($id);
                    $media_delete = Storage::disk('public')->delete('files/event-media/' . $media->file);

                    if ($media_delete) {
                        $encryptFileName = $file->hashName();
                        // file Store
                        $file->store('public/files/event-media');
                    }
                }
            } elseif ($request->jenis == 'youtube') {
                $media = EventMedia::find($id);
                $media_delete = Storage::disk('public')->delete('files/event-media/' . $media->file);
                $get_link_youtube = explode("/", $request->link);
                $link_youtube = end($get_link_youtube);
                // $link_youtube = $get_link_youtube[3];


                // get thumbnail youtube
                $url = "https://www.youtube.com/live/" . $link_youtube;
                ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
                $get_thumbnail_youtube = get_meta_tags($url);
                $thumbnail_youtube = $get_thumbnail_youtube['twitter:image'];
            } elseif ($request->jenis == 'spotify') {
                $media = EventMedia::find($id);
                $media_delete = Storage::disk('public')->delete('files/event-media/' . $media->file);
                $get_link_spotify = explode("/", $request->link);
                $link_spotify = $get_link_spotify[4];

                // get thumbnail spotify
                $url = $request->link;
                ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
                $get_thumbnail_spotify = get_meta_tags($url);
                $thumbnail_spotify = $get_thumbnail_spotify['twitter:image'];
            }
        } elseif ($request->jenis == 'youtube') {
            // get link youtube
            $get_link_youtube = explode("/", $request->link);
            // $link_youtube = $get_link_youtube[3];
            $link_youtube = end($get_link_youtube);


            // get thumbnail youtube
            $url = "https://www.youtube.com/live/" . $link_youtube;
            ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
            $get_thumbnail_youtube = get_meta_tags($url);
            $thumbnail_youtube = $get_thumbnail_youtube['twitter:image'];
        } elseif ($request->jenis == 'spotify') {
            // get link spotify
            $get_link_spotify = explode("/", $request->link);
            $link_spotify = $get_link_spotify[4];

            // get thumbnail spotify
            $url = $request->link;
            ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
            $get_thumbnail_spotify = get_meta_tags($url);
            $thumbnail_spotify = $get_thumbnail_spotify['twitter:image'];
        } elseif ($request->jenis == 'image') {
            // get Image
            $file = $request->file('file');

            if ($file != null) {
                // $media = EventMedia::find($id);
                // $media_delete = Storage::disk('public')->delete('files/event-media/' . $media->file);

                // if ($media_delete) {
                $encryptFileName = $file->hashName();
                // file Store
                $file->store('public/files/event-media');
                // }
            }
        }

        $eventMedia = EventMedia::find($id);
        $eventMedia->event_id = $request->nama;
        $eventMedia->judul = $request->judul;

        if ($request->jenis == 'image') {
            if ($file != null) {
                $eventMedia->file = $encryptFileName;
            }
        } elseif ($request->jenis == 'youtube') {
            $eventMedia->file = $link_youtube;
            $eventMedia->thumbnail = $thumbnail_youtube;
        } elseif ($request->jenis == 'spotify') {
            $eventMedia->file = $link_spotify;
            $eventMedia->thumbnail = $thumbnail_spotify;
        }

        $eventMedia->jenis = $request->jenis;
        $eventMedia->deskripsi = $request->deskripsi;
        if ($request->utama == 'utama') {
            $eventMedia->utama = 1;
        } else {
            $eventMedia->utama = 0;
        }


        $eventMedia->save();
        return redirect()->route('events.show', ['event' => $request->nama]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = EventMedia::find($id);
        $media_delete = Storage::disk('public')->delete('files/event-media/' . $media->file);
        if ($media_delete) {
            $media->delete();
        }
        return redirect()->route('events.show', ['event' => $media->event_id]);
    }
}
