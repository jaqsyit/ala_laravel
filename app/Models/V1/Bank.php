<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id', 'income', 'profit', 'expense'];
    protected $table = 'banks';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static function allBanks($idUser)
    {
        return self::where('user_id', $idUser)->orderBy('id', 'desc')->get();
    }

    public static function newRow($data)
    {
        $newRow = new self();
        $newRow->user_id = $data['filialId'];
        $newRow->name = $data['name'];
        $newRow->income = $data['income'];
        $newRow->profit = $data['profit'];
        $newRow->expense = $data['expense'];

        $newRow->save();

        return $newRow;
    }
}
