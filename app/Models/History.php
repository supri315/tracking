<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class History extends Model
{
    protected $table = 'history';
    protected $fillable = [
        'transaction_id',
        'goods_entry',
        'goods_entry_port',
        'goods_arrive_port',
        'sorting_process_destination',
        'process_send_destination',
        'courier',
        'status_id',
        'description',
        'latitude',
        'longitude',
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "history.id",
             "history.goods_entry",
             "history.goods_entry_port",
             "history.goods_arrive_port",
             "history.sorting_process_destination",
             "history.process_send_destination",
             "history.status_id",
             "history.description",
             "history.latitude",
             "history.longitude",
        ]);
     }
}
