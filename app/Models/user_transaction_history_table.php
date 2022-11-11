<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_transaction_history_table extends Model
{
    use HasFactory;
    protected $fillable = [
        'pk_id',
        'identification',
        'tradeNumber',
        'trxtype',
        'user_name',
        'virtual_account',
        'amount',
        'balance',
        'date_ymd',
        'date_time',
        'company_name'
    ];
}
