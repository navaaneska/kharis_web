<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPesertaPresensi extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function event_qrcode()
    {
        return $this->belongsTo('App\Models\EventQrcode', 'qrcode_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
