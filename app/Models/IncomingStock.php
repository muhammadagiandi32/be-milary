<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingStock extends Model
{
    use HasFactory;
    protected $table = 'incoming_stocks';
    protected $fillable = ['uuid', 'StockId', 'ItemsId', 'StockId', 'total', 'Price', 'created_at'];
    protected $hidden = ['id'];
    // public $keyType = 'string';
}
