<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    protected $table = 'city';
    protected $fillable = [
        'name'
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "city.id",
             "city.name",
        ]);
     }
}
