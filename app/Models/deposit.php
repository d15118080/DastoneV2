<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deposit extends Model
{
    use HasFactory;
        public $timestamps = false; //created_at, updated_at 컬럼 사용 안함

        protected $fillable = [
        'id',
        'user_name',
        'money',
        'state',
        'date_ymd',
        'date_time'
        ];
}
