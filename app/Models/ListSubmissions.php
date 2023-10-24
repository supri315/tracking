<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ListSubmissions extends Model
{
    protected $table = 'list_submissions';
    protected $fillable = [
        'end_date',
        'user_id',
        'transaction_id',
        'disctric_id'
    ];

    public function scopeGetAll($query) {
        return $query
        ->select([
             "list_submissions.id",
             "list_submissions.end_date",
             "list_submissions.user_id",
             "list_submissions.transaction_id",
             "list_submissions.disctric_id",
             "users.name",
             \DB::raw('count(*) as total_transaction')

        ])
        ->join('users', 'users.id', '=', 'list_submissions.user_id');
     }

     public function scopeGetPrint($query) {
        return $query
        ->select([
            "list_submissions.id",
            "list_submissions.end_date",
            "list_submissions.user_id",
            "list_submissions.transaction_id",
            "list_submissions.disctric_id",
            "users.name",
            "transaction.receiver",
            "transaction.awb",
            "transaction.receiver_address",
            "transaction.kelurahan",
            "transaction.phone_receiver",
            "transaction.coli_total",
            "disctric.name as kecamatan",
        ])
        ->join('disctric', 'disctric.id','=','list_submissions.disctric_id')
        ->join('transaction', 'transaction.id','=','list_submissions.transaction_id')
        ->join('users', 'users.id', '=', 'list_submissions.user_id');
     }
}
