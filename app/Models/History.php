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
             "history.courier",
             "history.transaction_id",
             "transaction.coli_total",
             "transaction.weight_total",
             "transaction.volume_total",
             "transaction.code",
             "transaction.awb",
        ])
        ->join('transaction','transaction.id','=','history.transaction_id')
        ->whereNotNull('goods_entry')
        ->whereNotNull('goods_entry_port')
        ->whereNotNull('goods_arrive_port')
        ->whereNotNull('sorting_process_destination')
        ->whereNotNull('process_send_destination')
        ->where('status_id',5)
        ;
     }
}
