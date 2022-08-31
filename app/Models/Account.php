<?php

namespace App\Models;

use Dotenv\Parser\Value;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Account extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'username',
        'email_verified_id',
        'password',
        'remember_token',
        'foto',
        'whatsapp',
        'slack',
        'role_id',
        'status',
        'value'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function values()
    {
        return $this->belongsTo(Values::class, 'value');
    }
}
