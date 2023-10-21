<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Administrator extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cuil',
        'email',
        'active',
        'privilege',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
