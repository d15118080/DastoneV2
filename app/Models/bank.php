<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;
    public $timestamps = false; //created_at, updated_at 컬럼 사용 안함

        protected $fillable = [
        'id',
        'bank_name',
        'bank_number'
        ];
}
