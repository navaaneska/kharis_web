<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function event_pengisi_acara()
    {
        return $this->hasMany(Event_Pengisi_Acara::class, 'user_id');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'created_by');
        return $this->hasMany(Event::class, 'updated_by');
    }

    public function event_peserta()
    {
        return $this->hasMany(EventPeserta::class, 'user_id');
        return $this->hasMany(EventPeserta::class, 'created_by');
    }

    public function event_peserta_presensi()
    {
        return $this->hasMany(EventPesertaPresensi::class, 'user_id');
    }

    // Keluarga

    public function ayah_id()
    {
        return $this->hasMany(User::class, 'ayah_id');
    }
    public function ibu_id()
    {
        return $this->hasMany(User::class, 'ibu_id');
    }
    public function pasangan_id()
    {
        return $this->hasMany(User::class, 'pasangan_id');
    }

    public function ayah()
    {
        return $this->belongsTo(User::class, 'ayah_id');
    }
    public function ibu()
    {
        return $this->belongsTo(User::class, 'ibu_id');
    }
    public function pasangan()
    {
        return $this->belongsTo(User::class, 'pasangan_id');
    }
}
