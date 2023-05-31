<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingStock extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'StockId', 'ItemsId', 'StockId', 'total', 'Price', 'created_at'];
    protected $hidden = ['id'];
}
