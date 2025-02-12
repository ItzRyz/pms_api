<?php

namespace App\Models\Master;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "msuser";

    protected $fillable = [
        "name",
        "email",
        "password",
        "company",
        "isactive",
        "isadmin"
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
