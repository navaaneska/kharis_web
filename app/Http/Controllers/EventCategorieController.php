<?php

namespace App\Http\Controllers;

use App\Models\EventCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = "Kategori";
        $categories = EventCategorie::all();

        return view('event_categorie.index', compact('categories', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Kategori";

        return view('event_categorie.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'image' => 'Isi :atribute dengan foto'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // get Icon
        $icon = $request->file('icon');
        // get Image
        $image = $request->file('image');

        if ($icon != null) {
            $encryptFileNameIcon = $icon->hashName();
            // icon Store
            $upload_icon = $icon->store('public/files/event-categorie');
        }
        if ($image != null) {
            $encryptFileNameImage = $image->hashName();
            // icon Store
            $upload_image = $image->store('public/files/event-categorie');
        }

        $eventCategorie = new EventCategorie;
        $eventCategorie->nama = $request->nama;

        if ($icon != null && $upload_icon) {
            $eventCategorie->icon = $encryptFileNameIcon;
        }
        if ($image != null && $upload_image) {
            $eventCategorie->image = $encryptFileNameImage;
        }

        $eventCategorie->save();

        return redirect()->route('events-categorie.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = EventCategorie::find($id);
        $pageTitle = "Kategori";

        return view('event_categorie.show', compact('kategori', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = EventCategorie::find($id);
        $pageTitle = "Kategori";

        return view('event_categorie.edit', compact('kategori', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'image' => 'Isi :atribute dengan foto'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // get Icon
        $file_icon = $request->file('icon');
        // get Image
        $file_image = $request->file('image');


        if ($file_icon != null) {

            $icon = EventCategorie::find($id);
            $icon_delete = Storage::disk('public')->delete('files/event-categorie/' . $icon->icon);

            if ($icon_delete) {
                $encryptFileNameIcon = $file_icon->hashName();
                // icon Store
                $icon_succes = $file_icon->store('public/files/event-categorie');
            }
        }

        if ($file_image != null) {
            $image = EventCategorie::find($id);
            $image_delete = Storage::disk('public')->delete('files/event-categorie/' . $image->image);

            if ($image_delete) {
                $encryptFileNameImage = $file_image->hashName();
                // icon Store
                $image_succes = $file_image->store('public/files/event-categorie');
            }
        }


        $eventCategorie = EventCategorie::find($id);
        $eventCategorie->nama = $request->nama;

        if ($file_icon != null && $icon_succes) {
            $eventCategorie->icon = $encryptFileNameIcon;
        }
        if ($file_image != null && $image_succes) {
            $eventCategorie->image = $encryptFileNameImage;
        }

        $eventCategorie->save();
        return redirect()->route('events-categorie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = EventCategorie::find($id);
        $kategori_icon_delete = Storage::disk('public')->delete('files/event-categorie/' . $kategori->icon);
        $kategori_image_delete = Storage::disk('public')->delete('files/event-categorie/' . $kategori->image);
        if ($kategori_icon_delete && $kategori_image_delete) {
            $kategori->delete();
        }
        return redirect()->route('events-categorie.index');
    }
}
