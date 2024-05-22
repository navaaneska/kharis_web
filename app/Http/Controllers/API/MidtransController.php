<?php

namespace App\Http\Controllers\API;

use App\Traits\codeGenerate;
use App\Http\Controllers\Controller;
use App\Models\EventTransaksies;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    use CodeGenerate;
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
    public function create(Request $request)
    {
        $username = env('MIDTRANS_SERVER_KEY');
        $midtrans_auth = $username . ':';

        $payment_type = "";
        $bank = $request->bank;

        $header = [
            'Content-type'  => 'application/json',
            'Accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($midtrans_auth)
        ];

        $transaction = array(
            'order_id' => $request->order_id,
            'gross_amount' => (int)$request->amount
        );

        $bank_transfer = array(
            'bank' => $bank,
            "va_number" => substr(Auth::user()->whatsapp, -11)
        );

        if (!isset(explode(" ", Auth::user()->name)[1])) {
            $user_info = array(
                'email' => Auth::user()->email,
                'first_name' => ucwords(explode(" ", Auth::user()->name)[0]),
                'phone' => Auth::user()->whatsapp
            );
        } else {
            $user_info = array(
                'email' => Auth::user()->email,
                'first_name' =>  ucwords(explode(" ", Auth::user()->name)[0]),
                'last_name' => ucwords(explode(" ", Auth::user()->name)[1]),
                'phone' => Auth::user()->whatsapp
            );
        }

        $item_details = array(
            'price' => (int)$request->price_item,
            'quantity' => (int)$request->quantity_item,
            'name' => $request->name_item
        );

        $item_details_admin = array(
            'price' => 4000,
            'quantity' => 1,
            'name' => "Biaya Admin"
        );

        if ($bank == 'bca' || $bank == 'bni' || $bank == 'bri' || $bank == 'cimb') {
            $payment_type = "bank_transfer";

            $transaction_data = array(
                'payment_type' => $payment_type,
                'transaction_details' => $transaction,
                'customer_details' => $user_info,
                'item_details' => [$item_details, $item_details_admin],
                'bank_transfer' => $bank_transfer,
            );
        } else if ($bank == 'mandiri') {
            $payment_type = "echannel";

            $echannel = array(
                'bill_info1' => "Payment:",
                'bill_info2' => "Kharis Mobile",
                'bill_key' => substr(Auth::user()->whatsapp, -11)
            );

            $transaction_data = array(
                'payment_type' => $payment_type,
                'transaction_details' => $transaction,
                'customer_details' => $user_info,
                'item_details' => [$item_details, $item_details_admin],
                'echannel' => $echannel
            );
        } else if ($bank == 'permata') {
            $payment_type = "permata";

            $transaction_data = array(
                'payment_type' => $payment_type,
                'transaction_details' => $transaction,
                'customer_details' => $user_info,
                'item_details' => [$item_details, $item_details_admin],
                'bank_transfer' => $bank_transfer
            );
        }

        $response = Http::withHeaders($header)->post('https://api.sandbox.midtrans.com/v2/charge', $transaction_data);
        $data = json_decode($response->getBody(), true);

        // update database
        // $updateTransaksi = EventTransaksies::where('order_id', $request->order_id)->get();

        if ($bank == 'bca' || $bank == 'bni' || $bank == 'bri' || $bank == 'cimb') {
            DB::table('event_transaksies')
            ->where('order_id', $request->order_id)
                ->update([
                    'transaction_date' => Carbon::now(),
                    'transaction_time' => $data['transaction_time'],
                    'transaction_id' => $data['transaction_id'],
                    'payment_type' => $data['payment_type'],
                    'bank' => $data['va_numbers'][0]['bank'],
                    'va_number' => $data['va_numbers'][0]['va_number'],
                    'status_bayar' => $data['transaction_status'],
                    'expiry_time' => $data['expiry_time'],
                ]);
        } else if ($bank == 'mandiri') {
            DB::table('event_transaksies')
            ->where('order_id', $request->order_id)
                ->update([
                    'transaction_date' => Carbon::now(),
                    'transaction_time' => $data['transaction_time'],
                    'transaction_id' => $data['transaction_id'],
                    'payment_type' => $data['payment_type'],
                    'bank' => 'mandiri',
                    'va_number' => $data['bill_key'],
                    'status_bayar' => $data['transaction_status'],
                    'expiry_time' => $data['expiry_time'],
                ]);
        } else if ($bank == 'permata') {
            DB::table('event_transaksies')
            ->where('order_id', $request->order_id)
                ->update([
                    'transaction_date' => Carbon::now(),
                    'transaction_time' => $data['transaction_time'],
                    'transaction_id' => $data['transaction_id'],
                    'payment_type' => $data['payment_type'],
                    'bank' => 'permata',
                    'va_number' => $data['permata_va_number'],
                    'status_bayar' => $data['transaction_status'],
                    'expiry_time' => $data['expiry_time'],
                ]);
        }

        return response()->json($data);
    }

    public function midtrans_hook(Request $request)
    {
        $result = file_get_contents('php://input');
        $data = json_decode($result, true);

        $status = "";
        if ($data['transaction_status'] == "settlement" || $data['transaction_status'] == "capture") {
            $status = 'Sukses';

            DB::table('event_transaksies')
            ->where('order_id', $data['order_id'])
                ->update([
                    'status_bayar' => $status,
                ]);
        } else if($data['transaction_status'] == "expire"){
            $kode = $this->getCode();

            DB::table('event_transaksies')
            ->where('order_id', $data['order_id'])
                ->update([
                    'order_id' => $kode,
                    'transaction_date' => null,
                    'transaction_time' => null,
                    'transaction_id' => null,
                    'payment_type' => null,
                    'bank' => null,
                    'va_number' => null,
                    'status_bayar' => 'belum bayar',
                    'expiry_time' => null,
                ]);
        } else {
            $status = $data['transaction_status'];

            DB::table('event_transaksies')
            ->where('order_id', $data['order_id'])
                ->update([
                    'status_bayar' => $status,
                ]);
        }

        return response()->json($data);
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
}
