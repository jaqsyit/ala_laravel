<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sklad extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'quantity', 'price', 'oz_price', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function skladActivity()
    {
        return $this->hasMany(SkladActivity::class);
    }

    public static function allSklad($idUser)
    {
        return self::where('user_id', $idUser)->get();
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

    public static function checkQuantity($id)
    {
        return self::find($id);
    }


    public static function newQuantity($data, $id)
    {
        return self::where('id', $id)->update(['quantity' => $data['quantity']]);
    }

}
