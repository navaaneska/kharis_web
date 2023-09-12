<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }
}
