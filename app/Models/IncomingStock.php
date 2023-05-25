<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingStock extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'StockId', 'ItemsId', 'StockId', 'total', 'Price'];
    protected $hidden = ['id'];
    public $keyType = 'string';
}
