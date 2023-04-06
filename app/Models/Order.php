<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'ItemsId', 'Qty'];
    protected $hidden = ['OrderId', 'id'];
    public $keyType = 'string';
    // protected $guarded = ['ItemsId'];
}
