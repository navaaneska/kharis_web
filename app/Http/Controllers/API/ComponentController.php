<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function JumlahKegiatan()
    {
        return response()->json([
            'kegiatanku' => 2,
            'total_kegiatan' => 5,
        ], 200);
    }

    public function JumlahPelayanan()
    {
        return response()->json([
            'pelayananku' => 0,
            'total_pelayanan' => 5,
        ], 200);
    }

    public function JumlahBookmark()
    {
        return response()->json([
            'bookmark' => 5,
        ], 200);
    }
}
