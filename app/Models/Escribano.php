<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condition;
use App\Models\User;
class Escribano extends Model
{
    use HasFactory;
    protected $table = 'escribanos';
    protected $fillable = [
        'nombre',
        'apellido',
        'matricula',
        'dni',
        'cuil',
        'sexo',
        'direccion',
        'telefono',
        'email',
        'condicion_id',
        'user_id',
    ];

    public function condicion(){
        return $this->belongsTo(Condition::class, 'condicion_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
