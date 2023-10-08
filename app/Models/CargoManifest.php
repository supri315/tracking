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
             "cargo_manifest.ship_name",
             "cargo_manifest.start_date",
             "cargo_manifest.end_date",
             "cargo_manifest.source_branch_id",
             "cargo_manifest.destination_source_id",
             "cargo_manifest.no_docs",
             "cargo_manifest.nopol",
             "cargo_manifest.driver",
             "cargo_manifest.transaction_id",
        ]);
     }
}
