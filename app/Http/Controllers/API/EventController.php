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

    public function event_kategori_by_jenis_kategori(string $kategori)
    {
        // $get_event_by_kategori = Event::where('kategori_id', $kategori)
        //     ->orWhere('kategori2_id', $request->kategori)
        //     ->orWhere('kategori3_id', $request->kategori)
        //     ->get();

        // $get_event_by_onsite = $get_event_by_kategori->where('online', 0);
        // $get_event_by_online = $get_event_by_kategori->where('online', 1);
        // $get_event_by_hybrid = $get_event_by_kategori->where('online', 2);

        // $get_event_by_kategori = Event::where('kategori_id', $kategori)

        $get_event_by_kategori = Event::with('event_media')->where('kategori_id', $kategori)
            ->orWhere('kategori2_id', $kategori)
            ->orWhere('kategori3_id', $kategori)
            ->get();

        $get_event_by_onsite = $get_event_by_kategori->where('online', 0);
        $get_event_by_online = $get_event_by_kategori->where('online', 1);
        $get_event_by_hybrid = $get_event_by_kategori->where('online', 2);

        return response()->json([
            'get_event_by_kategori' => $get_event_by_kategori,
            'get_event_by_onsite' => $get_event_by_onsite,
            'get_event_by_online' => $get_event_by_online,
            'get_event_by_hybrid' => $get_event_by_hybrid

        ], 200);
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

    public function event_percobaan(Request $request)
    {
        // Get Event By Kategori and Jenis


        if ($request->kategori && $request->online) {
            if ($request->online == "onsite") {
                $get_event_by_kategori = Event::with('event_media')->where('kategori_id', $request->kategori)
                    ->orWhere('kategori2_id', $request->kategori)
                    ->orWhere('kategori3_id', $request->kategori)->get();

                $get_event_by_onsite = [];
                for ($i = 0; $i < count($get_event_by_kategori); $i++) {
                    if ($get_event_by_kategori[$i]['online'] == '0') {
                        array_push($get_event_by_onsite, $get_event_by_kategori[$i]);
                    }
                }

                return response()->json([
                    'get_event_by_onsite' => $get_event_by_onsite,
                ], 200);
            }
            if ($request->online == "online") {
                $get_event_by_kategori = Event::with('event_media')->where('kategori_id', $request->kategori)
                    ->orWhere('kategori2_id', $request->kategori)
                    ->orWhere('kategori3_id', $request->kategori)->get();

                $get_event_by_online = [];
                for ($i = 0; $i < count($get_event_by_kategori); $i++) {
                    if ($get_event_by_kategori[$i]['online'] == '1') {
                        array_push($get_event_by_online, $get_event_by_kategori[$i]);
                    }
                }
                return response()->json([
                    'get_event_by_online' => $get_event_by_online,
                ], 200);
            }
            if ($request->online == "hybrid") {
                $get_event_by_kategori = Event::with('event_media')->where('kategori_id', $request->kategori)
                    ->orWhere('kategori2_id', $request->kategori)
                    ->orWhere('kategori3_id', $request->kategori)->get();

                $get_event_by_hybrid = [];
                for ($i = 0; $i < count($get_event_by_kategori); $i++) {
                    if ($get_event_by_kategori[$i]['online'] == '2') {
                        array_push($get_event_by_hybrid, $get_event_by_kategori[$i]);
                    }
                }
                return response()->json([
                    'get_event_by_hybrid' => $get_event_by_hybrid,
                ], 200);
            }
            return response()->json([
                'keterangan' => 'Pencarian tidak ditemukan',
            ], 400);
        }

        // Get Event By Kategori
        if ($request->kategori) {
            $get_event_by_kategori = Event::with('event_media')->where('kategori_id', $request->kategori)
                ->orWhere('kategori2_id', $request->kategori)
                ->orWhere('kategori3_id', $request->kategori)
                ->get();
            return response()->json([
                'get_event_by_kategori' => $get_event_by_kategori,
            ], 200);
        }

        // Get All Event List
        $events = Event::with('event_categorie', 'event_categorie2', 'event_categorie3')->get();

        return response()->json([
            'events' => $events,
        ], 200);
    }


    public function EventList(Request $request)
    {
        $events = Event::with('event_media', 'event_categorie');

        if (isset($request->kategori)) {
            $kategori = $request->kategori;
            $events->where(function ($q) use ($kategori) {
                $q->where('kategori_id', $kategori)
                    ->orWhere('kategori2_id', $kategori)
                    ->orWhere('kategori3_id', $kategori);
            });
        }
        if (isset($request->online)) {
            switch ($request->online) {
                case "online":
                    $events->whereIn('online', [1, 2]);
                    break;
                case "onsite":
                    $events->where('online', [0, 2]);
                    break;
                default:
                    break;
            }
        }
        if (isset($request->status)) {
            switch ($request->status) {
                case "open":
                    $events->whereIn('status', ['draft', 'open']);
                    break;
                case "close":
                    $events->where('status', ['finish', 'canceled']);
                    break;
                default:
                    break;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $events->get(),
        ], 200);
    }
}
