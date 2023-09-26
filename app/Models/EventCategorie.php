<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategorie extends Model
{
    use HasFactory;

    public function event()
    {
        // return $this->hasMany('App\Models\Event', 'kategori_id');
        // return $this->hasMany('App\Models\Event', 'kategori2_id');
        // return $this->hasMany('App\Models\Event', 'kategori3_id');

        return $this->hasMany('App\Models\Event', 'kategori_id');
        return $this->hasMany('App\Models\Event', 'kategori2_id');
        return $this->hasMany('App\Models\Event', 'kategori3_id');
    }
}
