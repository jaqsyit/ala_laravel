<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kezek extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'status',
        'mark',
        'model',
        'equipment',
        'year',
        'id_usluga',
        'linza',
        'sum',
        'sum_prepayment',
        'sum_usluga',
        'comment',
        'tel',
        'zapis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function banks(){
        return $this->hasMany(Bank::class,'kezek_id','id');
    }

    public static function allKezek($idUser)
    {
        return self::with('banks')->where('user_id', $idUser)->orderBy('id', 'desc')->get();
    }

    public static function newKezek($data)
    {
        $kezek = new self();
        $kezek->user_id = $data['filialId'];
        $kezek->status = false;
        $kezek->mark = $data['mark'];
        $kezek->model = $data['model'];
        $kezek->equipment = $data['equipment'];
        $kezek->year = $data['year'];
        $kezek->uslugi = $data['uslugi'];
        $kezek->linza = $data['linza'];
        $kezek->sum = $data['sum'];
        $kezek->comment = $data['comment'];
        $kezek->tel = $data['tel'];
        $kezek->zapis = $data['zapis'];

        $kezek->save();

        return $kezek;
    }
}
