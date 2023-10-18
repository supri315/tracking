<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class MasterKapal extends Model
{
    protected $table = 'master_kapal';
    protected $fillable = [
        'name'
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "master_kapal.id",
             "master_kapal.name"
        ]);
     }
}
