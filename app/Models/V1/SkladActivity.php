<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkladActivity extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id_sklad', 'add', 'quantity', 'create_at', 'user_id'];
    protected $table = 'sklad_activities';

    public function sklad()
    {
        return $this->belongsTo(Sklad::class, 'sklad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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


    public static function allSkladActivity($idUser)
    {
        return self::where('user_id', $idUser)->get();
    }
}
