<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uslugi extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'prise', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function allUslugi($idUser)
    {
        return self::where('user_id', $idUser)->get();
    }

    public static function newUsluga($data)
    {
        $usluga = new self();
        $usluga->user_id = $data['idUser'];
        $usluga->name = $data['name'];
        $usluga->price = $data['price'];

        $usluga->save();

        return $usluga;
    }
}
