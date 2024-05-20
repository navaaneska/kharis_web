<?php

namespace App\Http\Controllers\API;

use App\Traits\codeGenerate;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategorie;
use App\Models\EventMedia;
use App\Models\EventPeserta;
use App\Models\EventTransaksies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EventController extends Controller
{
    use CodeGenerate;
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

        $events = Event::with('event_categorie')
            ->with(['event_media' => function ($query) {
                $query->where('utama', '=', '1');
                // ->take(1)
            }]);

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
                    $events->whereIn('online', [0, 2]);
                    break;
                case "onsite":
                    $events->where('online', [1, 2]);
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
                    $events->whereIn('status', ['finish', 'canceled']);
                    break;
                default:
                    break;
            }
        }
        if (isset($request->group)) {
            switch ($request->group) {
                case 'family':
                    $group = [3, 9];
                    $events->where(function ($q) use ($group) {
                        $q->where('kategori_id', $group)
                            ->orWhere('kategori2_id', $group)
                            ->orWhere('kategori3_id', $group);
                    });
                    break;
                case 'marriage':
                    $group = [4, 5, 6];
                    $events->where(function ($q) use ($group) {
                        $q->where('kategori_id', $group)
                            ->orWhere('kategori2_id', $group)
                            ->orWhere('kategori3_id', $group);
                    });
                    break;
                case 'wedding':
                    $group = [7];
                    $events->where(function ($q) use ($group) {
                        $q->where('kategori_id', $group)
                            ->orWhere('kategori2_id', $group)
                            ->orWhere('kategori3_id', $group);
                    });
                    break;
                case 'parents':
                    $group = [8, 9];
                    $events->where(function ($q) use ($group) {
                        $q->where('kategori_id', $group)
                            ->orWhere('kategori2_id', $group)
                            ->orWhere('kategori3_id', $group);
                    });
                    break;
                case 'youth-gen':
                    $group = [8, 9];
                    $events->where(function ($q) use ($group) {
                        $q->where('kategori_id', $group)
                            ->orWhere('kategori2_id', $group)
                            ->orWhere('kategori3_id', $group);
                    });
                    break;
                default:
                    break;
            }
        }
        if (isset($request->content)) {
            switch ($request->content) {
                case "youtube":
                    $events = EventMedia::with('event')
                        ->where('jenis', 'youtube')->latest()
                        ->take($request->take);
                    break;
                case "spotify":
                    $events = EventMedia::where('jenis', 'spotify')
                        ->latest()
                        ->take($request->take);
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

    public function Streaming(Request $request)
    {
        $content = $request->content;

        $events = Event::with('event_categorie', 'event_pengisi_acara')
            ->with(['event_media' => function ($query) use ($content) {
                $query->where('jenis', '=', $content);
                // ->take(1);
            }]);

        if (isset($request->streaming)) {
            $streaming = $request->streaming;
            if ($request->streaming != 0) {
                $events->where(function ($q) use ($streaming) {
                    $q->where('kategori_id', $streaming)
                        ->orWhere('kategori2_id', $streaming)
                        ->orWhere('kategori3_id', $streaming);
                });
            }
        }
        if (isset($request->upcoming)) {

            $events = Event::with('event_categorie', 'event_pengisi_acara')
                ->with(['event_media' => function ($query) use ($content) {
                    $query->where('jenis', '=', $content)->orWhere('jenis', '=', 'image');
                    // ->take(1);
                }]);

            $streaming = $request->streaming;
            if ($request->streaming != 0) {
                $events->where(function ($q) use ($streaming) {
                    $q->where('kategori_id', $streaming)
                        ->orWhere('kategori2_id', $streaming)
                        ->orWhere('kategori3_id', $streaming);
                });
            }

            $events->where('status', $request->upcoming);
        }
        return response()->json([
            'success' => true,
            'data' => $events->get()
        ], 200);
    }

    // publi

    public function Media(Request $request)
    {
        $content = $request->content;
        $medias = EventMedia::with('event')->where('jenis', $content)->get();
        return response()->json([
            'success' => true,
            'data' => $medias
        ], 200);
    }

    public function CheckEvent(Request $request)
    {
        $event = EventPeserta::with('event', 'user', 'created_by');
        $getEventId = $request->event;
        $getUserId = $request->user;
        $event->where(function ($q) use ($getEventId, $getUserId) {
            $q->where('event_id', $getEventId)
                ->where('user_id', $getUserId);
        });
        $checkEvent = $event->first();

        if (isset($checkEvent)) {
            // Get Data Status Bayar
            $user = User::find($checkEvent->created_by);
            $getName = $user->name;
            $transaksi = EventTransaksies::with('user');
            $transaksi->where(function ($q) use ($getEventId, $getUserId) {
                $q->where('event_id', $getEventId)
                    ->where('user_id', $getUserId);
            });
            $checkTransaksi = $transaksi->first()->status_bayar;
        }


        if (isset($checkEvent)) {
            return response()->json([
                'success' => true,
                'data' => 'true',
                'message' => "Anda Sudah Mendaftar, Anda didaftarkan oleh $getName. Status Pembayaran saat ini adalah $checkTransaksi"
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => 'false'
            ], 200);
        }
    }

    public function DaftarEvent(Request $request)
    {
        $event = EventPeserta::with('event', 'user', 'created_by');
        $getEventId = $request->event_id;
        $getUserId = $request->user_id;
        $event->where(function ($q) use ($getEventId, $getUserId) {
            $q->where('event_id', $getEventId)
                ->where('user_id', $getUserId);
        });
        $checkEvent = $event->get();

        $kode = $this->getCode();

        if (count($checkEvent)) {
            $user = User::find($checkEvent[0]->created_by);
            $getName = $user->name;
            $transaksi = EventTransaksies::with('user');
            $transaksi->where(function ($q) use ($getEventId, $getUserId) {
                $q->where('event_id', $getEventId)
                    ->where('user_id', $getUserId);
            });
            $checkTransaksi = $transaksi->first()->status_bayar;
            // Sudah Daftar
            return response()->json([
                'message'       => "Anda Sudah Mendaftar, Anda didaftarkan oleh $getName. Status Pembayaran saat ini adalah $checkTransaksi",
            ], 200);
        } else {
            $getJumlahPendaftar = count(EventPeserta::where('event_id', $getEventId)->get());
            $getInfoEvent = Event::where('id', $getEventId)->first();
            $getInfoUser = User::find($request->user_id);

            if ($getInfoEvent->tipe_peserta == 0) {

                if ($getInfoEvent->maksimal_peserta > $getJumlahPendaftar) {
                    // Kuota Masih Ada
                    $daftarEvent = new EventPeserta;
                    $daftarEvent->event_id = $request->event_id;
                    $daftarEvent->user_id = $request->user_id;
                    $daftarEvent->created_by = $request->created_by;
                    if ($request->umur < 12) {
                        $daftarEvent->harga = $getInfoEvent->harga_anak;
                    } else {
                        $daftarEvent->harga = $getInfoEvent->harga_perorang;
                    }
                    $daftarEvent->save();

                    // Tambah Event Transaksi
                    $eventTransaksi = new EventTransaksies;
                    $eventTransaksi->id = Str::uuid();
                    $eventTransaksi->order_id = $kode;
                    $eventTransaksi->event_id = $request->event_id;
                    $eventTransaksi->user_id = $request->user_id;
                    if ($request->umur < 12) {
                        $eventTransaksi->jumlah_bayar = $getInfoEvent->harga_anak;
                    } else {
                        $eventTransaksi->jumlah_bayar = $getInfoEvent->harga_perorang;
                    }
                    $eventTransaksi->status_bayar = 'belum bayar';
                    $eventTransaksi->save();

                    return response()->json([
                        'message'       => 'Berhasil Daftar Event, Silahkan menuju halaman checkout untuk melanjutkan pemesanan event',
                        'user' => $daftarEvent,
                    ], 200);
                } else {
                    // Kuota Sudah Penuh
                    return response()->json([
                        'message'       => 'Kuota Sudah Penuh',
                    ], 200);
                }
            } elseif ($getInfoEvent->tipe_peserta == 1) {

                // Validasi Pasangan
                if ($getInfoUser->pasangan_id_approval == 1) {
                    if ($getInfoEvent->maksimal_peserta > $getJumlahPendaftar) {

                        // Kuota Masih Ada
                        $daftarEvent = new EventPeserta;
                        $daftarEvent->event_id = $request->event_id;
                        $daftarEvent->user_id = $request->user_id;
                        $daftarEvent->pasangan_id = $getInfoUser->pasangan_id;
                        $daftarEvent->created_by = $request->created_by;
                        $daftarEvent->harga = $getInfoEvent->harga_perevent;
                        $daftarEvent->save();

                        // Tambah Event Transaksi
                        $eventTransaksi = new EventTransaksies;
                        $eventTransaksi->id = Str::uuid();
                        $eventTransaksi->order_id = $kode;
                        $eventTransaksi->event_id = $request->event_id;
                        $eventTransaksi->user_id = $request->user_id;
                        $eventTransaksi->jumlah_bayar = $getInfoEvent->harga_perevent;
                        $eventTransaksi->status_bayar = 'belum bayar';
                        $eventTransaksi->save();

                        return response()->json([
                            'message'       => "Berhasil Daftar Event, Silahkan menuju halaman checkout untuk melanjutkan pemesanan event",
                            'user' => $daftarEvent,
                        ], 200);
                    } else {
                        // Kuota Sudah Penuh
                        return response()->json([
                            'message'       => 'Kuota Sudah Penuh',
                        ], 200);
                    }
                } else {
                    // Kuota Sudah Penuh
                    return response()->json([
                        'message'       => 'Anda masih belum memiliki approval pasangan',
                    ], 200);
                }
            } else {

                // Validasi Keluarga
                // if ($getInfoUser->ayah_id_approval == 1 && $getInfoUser->ibu_id_approval == 1) {
                if ($getInfoEvent->maksimal_peserta > $getJumlahPendaftar) {

                    // Kuota Masih Ada

                    // Daftar Anak
                    $daftarEvent = new EventPeserta;
                    $daftarEvent->event_id = $request->event_id;
                    $daftarEvent->user_id = $request->user_id;
                    $daftarEvent->created_by = $request->created_by;
                    if ($request->user_id == $request->created_by) {
                        $daftarEvent->harga = $getInfoEvent->harga_perevent;

                        // Tambah Event Transaksi
                        $eventTransaksi = new EventTransaksies;
                        $eventTransaksi->id = Str::uuid();
                        $eventTransaksi->order_id = $kode;
                        $eventTransaksi->event_id = $request->event_id;
                        $eventTransaksi->user_id = $request->user_id;
                        $eventTransaksi->jumlah_bayar = $getInfoEvent->harga_perevent;
                        $eventTransaksi->status_bayar = 'belum bayar';
                        $eventTransaksi->save();
                    } else {
                        $daftarEvent->harga = 0;
                    }

                    $daftarEvent->save();
                    $user = User::find($request->user_id)->name;


                    return response()->json([
                        'message'       => "$user Berhasil Daftar Event",
                        'user' => $daftarEvent,
                    ], 200);
                } else {
                    // Kuota Sudah Penuh
                    return response()->json([
                        'message'       => 'Kuota Sudah Penuh',
                    ], 200);
                }
                // }
                // else {
                //     // Kuota Sudah Penuh
                //     return response()->json([
                //         'message'       => 'Anda masih belum memiliki approval keluarga',
                //     ], 200);
                // }
            }
        }
    }

    public function CartList(Request $request)
    {
        $events = EventTransaksies::with('event')->where('user_id', $request->user)->get();

        return response()->json([
            'success' => true,
            'data' => $events
        ], 200);
    }

    public function CartListDetail(Request $request)
    {
        $events = EventTransaksies::with('event')->where('user_id', $request->user)->where('event_id', $request->event)->first();
        $pesertas = EventPeserta::with('user', 'pasangan')->where('created_by', $request->user)->where('event_id', $request->event)->get();

        return response()->json([
            'success' => true,
            'data' => $events,
            'peserta' => $pesertas
        ], 200);
    }
}
