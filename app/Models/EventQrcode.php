<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventQrcode extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    public function event_peserta_presensi()
    {
        return $this->hasMany('App\Models\PesertaPresensi', 'qrcode_id');
    }
}
