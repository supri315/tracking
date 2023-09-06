<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Branch extends Model
{
    protected $table = 'branch';
    protected $fillable = [
        'name',
        'address',
        'city_id',
        'latitude',
        'longitude',
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "branch.id",
             "branch.name",
             "branch.address",
             "branch.city_id",
             "city.name as city_name",
             "branch.latitude",
             "branch.longitude",
        ])
        ->join('city', 'city.id','=','branch.city_id');
     }
}
