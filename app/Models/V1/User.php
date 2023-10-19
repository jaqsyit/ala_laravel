<?php

namespace App\Models\V1;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function sklad()
    {
        return $this->hasMany(Sklad::class);
    }

    public function skladActivity()
    {
        return $this->hasMany(SkladActivity::class);
    }

    public function kezek()
    {
        return $this->hasMany(Kezek::class);
    }

    public function uslugi()
    {
        return $this->hasMany(Uslugi::class);
    }

    public function banks()
    {
        return $this->hasMany(Bank::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function chechEmail($email)
    {
        return self::where('email', $email)->first();
    }
}
