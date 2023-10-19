<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kezek extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'mark',
        'model',
        'equipment',
        'year',
        'uslugi',
        'linza',
        'sum',
        'comment',
        'tel',
        'zapis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function allKezek($idUser)
    {
        if ($idUser != 1) {
            return self::with('user')->where('user_id', $idUser)->get();
        } else {
            return self::with('user')->orderBy('id', 'desc')->get();
        }
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
