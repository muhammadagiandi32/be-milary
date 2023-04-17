<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Items extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'ItemName', 'Size', 'Price'];
    protected $hidden = ['IdItems', 'id'];
    public $keyType = 'string';
    protected $primaryKey = 'uuid';
    // public function item_details(): BelongsTo
    // {
    //     return $this->BelongsTo(Order::class);
    // }
}
