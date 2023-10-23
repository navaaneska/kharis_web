<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTransaksies extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
