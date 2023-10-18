<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class CargoManifest extends Model
{
    protected $table = 'cargo_manifest';
    protected $fillable = [
        'ship_name',
        'start_date',
        'end_date',
        'source_branch_id',
        'destination_source_id',
        'no_docs',
        'nopol',
        'driver',
        'transaction_id',
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "cargo_manifest.id",
             "cargo_manifest.kapal_id",
             "cargo_manifest.start_date",
             "cargo_manifest.end_date",
             "cargo_manifest.source_branch_id",
             \DB::raw("(select name from city where id = (select city_id from branch where id = cargo_manifest.source_branch_id))  as asal"),
             \DB::raw("(select name from city where id = (select city_id from branch where id = cargo_manifest.destination_source_id))  as tujuan"),
             "cargo_manifest.destination_source_id",
             "cargo_manifest.no_docs",
             "cargo_manifest.nopol",
             "cargo_manifest.driver",
             "cargo_manifest.transaction_id",
             \DB::raw('count(*) as total_transaction'),
             \DB::raw("(select name from master_kapal where id = cargo_manifest.kapal_id )  as ship_name"),

        ]);
     }

     public function scopeGetPrint($query) {
        return $query
        ->select([
             "cargo_manifest.id",
          //    "cargo_manifest.ship_name",
             "cargo_manifest.start_date",
             "cargo_manifest.end_date",
             "cargo_manifest.source_branch_id",
             \DB::raw("(select name from city where id = (select city_id from branch where id = cargo_manifest.source_branch_id))  as asal"),
             \DB::raw("(select name from city where id = (select city_id from branch where id = cargo_manifest.destination_source_id))  as tujuan"),
             "cargo_manifest.destination_source_id",
             "cargo_manifest.no_docs",
             "cargo_manifest.nopol",
             "cargo_manifest.driver",
             "cargo_manifest.transaction_id",
             "transaction.awb",
             "transaction.kecamatan",
             "transaction.kelurahan",
             "transaction.receiver_address",
             "transaction.receiver",
             "transaction.phone_receiver",
             "transaction.shipper",
             "transaction.shipper_phone",
             "transaction.coli_total",
             \DB::raw("(select name from master_kapal where id = cargo_manifest.kapal_id )  as ship_name"),

        ])
        ->join('transaction', 'transaction.id','cargo_manifest.transaction_id');
     }
}
