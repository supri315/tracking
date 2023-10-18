<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;



class Transaksi extends Model
{
    protected $table = 'transaction';
    protected $fillable = [
        'date',
        'awb',
        'shipper',
        'shipper_address',
        'shipper_phone',
        'receiver',
        'receiver_address',
        'kelurahan',
        'kecamatan',
        'phone_receiver',
        'coli_total',
        'weight_total',
        'volume_total',
        'code',
        'shipping_amount',
        'discount',
        'total_amount',
        'ship_date',
        'source_branch_id',
        'destination_branch_id',
        'disctric_id'
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "transaction.id",
             "transaction.awb",
             "transaction.shipper",
             "transaction.shipper_address",
             "transaction.shipper_phone",
             "transaction.receiver",
             "transaction.receiver_address",
             "transaction.kelurahan",
             "transaction.kecamatan",
             "transaction.phone_receiver",
             "transaction.coli_total",
             "transaction.weight_total",
             "transaction.volume_total",
             "transaction.code",
             "transaction.shipping_amount",
             "transaction.discount",
             "transaction.total_amount",
             "transaction.disctric_id",
             "transaction.ship_date",
             "transaction.source_branch_id",
             "transaction.destination_branch_id",
             \DB::raw("(select name from city where id = (select city_id from branch where id = transaction.source_branch_id))  as cabang"),
             \DB::raw("(select status.name from status where id = (select history_transaction.status_id from history_transaction where transaction_id = transaction.id order by id desc limit 1) )  as status"),
        ]);
        // ->join('branch', 'branch.id','=','transaction.branch_id');
     }
}


