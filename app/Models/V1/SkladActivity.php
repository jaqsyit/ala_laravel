<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkladActivity extends Model
{
    use HasFactory;

    protected $fillable = ['id_sklad', 'add', 'quantity', 'create_at','id_user'];
    protected $table = 'sklad_activities';

    public function sklad()
    {
        return $this->belongsTo(Sklad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function newActivity($data)
    {
        $activity = new self();
        $activity->quantity = $data['quantity'];
        $activity->user_id = $data['idUser'];
        $activity->sklad_id = $data['idSklad'];
        $activity->add = $data['add'];

        $activity->save();

        return $activity;
    }


    public static function allTovars($idUser)
    {
        if ($idUser != 1) {
            return self::where('id_user', $idUser)->orderBy('id', 'desc')->get();
        } else {
            return self::orderBy('id', 'desc')->get();
        }
    }
}
