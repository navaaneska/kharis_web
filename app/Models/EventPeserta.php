<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPeserta extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function pasangan()
    {
        return $this->belongsTo(User::class, 'pasangan_id');
    }
}
