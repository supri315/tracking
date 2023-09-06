<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    protected $table = 'role';
    protected $fillable = [
        'name'
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "role.id",
             "role.name"
        ]);
     }
}
