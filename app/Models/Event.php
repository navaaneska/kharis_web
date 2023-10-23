<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function event_categorie()
    {
        // return $this->belongsToMany('App\Models\Event_Categorie', 'kategori_id');
        // return $this->belongsToMany('App\Models\Event_Categorie', 'kategori2_id');
        // return $this->belongsToMany('App\Models\Event_Categorie', 'kategori3_id');

        return $this->belongsTo('App\Models\EventCategorie', 'kategori_id');
        // return $this->belongsTo('App\Models\Event_Categorie', 'kategori2_id');
        // return $this->belongsTo('App\Models\Event_Categorie', 'kategori3_id');
    }
    public function event_categorie2()
    {
        // return $this->belongsTo('App\Models\Event_Categorie', 'kategori_id');
        return $this->belongsTo('App\Models\EventCategorie', 'kategori2_id');
        // return $this->belongsTo('App\Models\Event_Categorie', 'kategori3_id');
    }
    public function event_categorie3()
    {
        // return $this->belongsTo('App\Models\Event_Categorie', 'kategori_id');
        // return $this->belongsTo('App\Models\Event_Categorie', 'kategori2_id');
        return $this->belongsTo('App\Models\EventCategorie', 'kategori3_id');
    }

    public function event_media()
    {
        return $this->hasMany('App\Models\EventMedia', 'event_id');
    }

    public function event_peserta()
    {
        return $this->hasMany(EventPeserta::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'created_by');
        return $this->belongsToMany(User::class, 'updated_by');
    }

    public function event_pengisi_acara()
    {
        return $this->hasMany(EventPengisiAcara::class, 'event_id');
    }

    public function event_qrcode()
    {
        return $this->hasMany('App\Models\Event', 'event_id');
    }

    public function event_tranaksi()
    {
        return $this->hasMany(EventTransaksies::class, 'event_id');
    }
}
