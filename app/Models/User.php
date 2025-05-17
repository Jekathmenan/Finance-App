<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name', 'username', 'email', 'role', 'password', 'reset_challenge', 'status'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isAdmin()
    {
        return strtoupper($this->role) === "ADMIN" || strtoupper($this->role) === "SUPERADMIN";
    }
}
