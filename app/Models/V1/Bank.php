<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'income', 'profit', 'expense'];
    protected $table = 'banks';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static function allBanks($idUser)
    {
        if ($idUser != 1) {
            return self::with('user')->where('id_user', $idUser)->get();
        } else {
            return self::with('user')->get();
        }
    }
}
