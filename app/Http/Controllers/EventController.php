<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();

        // dd($events);

        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Event_Categorie::all();
        $statuses = ['draft', 'open', 'finish', 'canceled'];

        // dd($status);

        return view('event.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'ketentuan' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'maksimal_peserta' => 'required',
            'kategori_id' => 'required',
            'kategori2_id' => 'required',
            'kategori3_id' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Add Data
        $event = new Event;
        $event->kategori_id = $request->kategori_id;
        if ($request->kategori2_id != 0) {
            $event->kategori2_id = $request->kategori2_id;
        } else {
            $event->kategori2_id = null;
        }
        if ($request->kategori3_id != 0) {
            $event->kategori3_id = $request->kategori3_id;
        } else {
            $event->kategori3_id = null;
        }
        $event->kategori3_id = $request->kategori3_id;
        $event->nama = $request->nama;
        $event->deskripsi = $request->deskripsi;
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->lat = $request->lat;
        $event->lng = $request->lng;
        $event->ketentuan = $request->ketentuan;
        $event->status = $request->status;
        $event->harga = $request->harga;
        $event->maksimal_peserta = $request->maksimal_peserta;
        $event->qr = null;
        $event->created_by = auth()->user()->id;
        $event->updated_by = auth()->user()->id;



        $event->save();
        return redirect()->route('events.index');
        // $data = $request->all();
        // dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);

        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        $statuses = ['draft', 'open', 'finish', 'canceled'];
        $categories = Event_Categorie::all();

        return view('event.edit', compact('event', 'statuses', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'ketentuan' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'maksimal_peserta' => 'required',
            'kategori_id' => 'required',
            'kategori2_id' => 'required',
            'kategori3_id' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event = Event::find($id);
        $event->kategori_id = $request->kategori_id;
        if ($request->kategori2_id != 0) {
            $event->kategori2_id = $request->kategori2_id;
        } else {
            $event->kategori2_id = null;
        }
        if ($request->kategori3_id != 0) {
            $event->kategori3_id = $request->kategori3_id;
        } else {
            $event->kategori3_id = null;
        }
        $event->nama = $request->nama;
        $event->deskripsi = $request->deskripsi;
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->lat = $request->lat;
        $event->lng = $request->lng;
        $event->ketentuan = $request->ketentuan;
        $event->status = $request->status;
        $event->harga = $request->harga;
        $event->maksimal_peserta = $request->maksimal_peserta;
        $event->qr = null;
        $event->created_by = auth()->user()->id;
        $event->updated_by = auth()->user()->id;

        $event->save();
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::find($id)->delete();

        return redirect()->route('events.index');
    }
}
