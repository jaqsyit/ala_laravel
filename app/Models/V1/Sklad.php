<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sklad extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'quantity', 'price', 'oz_price', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skladActivity()
    {
        return $this->hasMany(SkladActivity::class);
    }

    public static function allTovars($idUser)
    {
        if ($idUser != 1) {
            return self::where('id_user', $idUser)->get();
        } else {
            return self::all();
        }
    }

    public static function newTovar($data)
    {
        $tovar = new self();
        $tovar->user_id = $data['idUser'];
        $tovar->name = $data['name'];
        $tovar->quantity = $data['quantity'];
        $tovar->price = $data['price'];
        $tovar->oz_price = $data['ozPrice'];

        $tovar->save();

        return $tovar;
    }


    public static function newQuantity($data, $id)
    {
        self::where('id', $id)->update(['quantity' => intval($data['quantity'])]);

        if (!self::find($id)) {
            return response()->json(['error' => 'Элемент не найден'], 404);
        }

        return self::find($id);
    }
}
