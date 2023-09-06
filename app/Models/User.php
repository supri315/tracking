<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'branch_id',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

 

    public function scopeGetAll($query) {
        return $query
        ->select([
             "users.id",
             "users.name",
             "users.email",
             "users.phone_number",
             "users.role_id",
             "role.name as role_name",
             "users.branch_id",
             "branch.name as branch_name",
             "branch.city_id",
             
        ])
        ->join('role', 'users.role_id', '=', 'role.id')
        ->join('branch', 'users.branch_id', '=', 'branch.id');
     }
}
