<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegarm_set extends Model
{
    use HasFactory;
      protected $table = "telegarm_sets";
        protected $fillable = [
        'id',
        'ck_id',
        'chat_id'
        ];
}
