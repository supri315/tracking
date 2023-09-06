<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Disctric extends Model
{
    protected $table = 'disctric';
    protected $fillable = [
        'city_id',
        'name',
        'latitude',
        'longitude',
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "disctric.id",
             "disctric.city_id",
             "disctric.name",
             "disctric.latitude",
             "disctric.longitude",
        ]);
     }
}
