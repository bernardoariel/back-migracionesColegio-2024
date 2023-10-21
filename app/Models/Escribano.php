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
        'register_number',
        'dni',
        'cuil',
        'sexo',
        'address', // Cambio de nombre
        'telefono',
        'email',
        'condition_id',
        'user_id',
    ];

    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
