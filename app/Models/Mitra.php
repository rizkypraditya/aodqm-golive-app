<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'gender',
    ];

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }
}
