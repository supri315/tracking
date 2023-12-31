<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class HistoryTransaction extends Model
{
    protected $table = 'history_transaction';
    protected $fillable = [
        'transaction_id',
        'courier',
        'status_id',
        'description',
        'latitude',
        'longitude',
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "history_transaction.id",
             "history_transaction.transaction_id",
             "history_transaction.courier",
             "history_transaction.status_id",
             "history_transaction.description",
             "history_transaction.latitude",
             "history_transaction.longitude",
        ]);
     }

    public function scopeGetTracking($query) {
        return $query
        ->select([
             "history_transaction.id",
             "history_transaction.transaction_id",
             "history_transaction.courier",
             "history_transaction.status_id",
             "history_transaction.description",
             "history_transaction.latitude",
             "history_transaction.longitude",
             "transaction.awb",
             "transaction.receiver",
             "status.name",
             "history_transaction.created_at",
        ])
        ->join('transaction', 'transaction.id','=','history_transaction.transaction_id')
        ->join('status', 'status.id','=','history_transaction.status_id');
     }
}
