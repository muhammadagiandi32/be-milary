<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'ItemsId', 'Qty'];
    protected $hidden = ['OrderId', 'id'];
    public $keyType = 'string';
    protected $primaryKey = 'uuid';
    // protected $guarded = ['ItemsId'];

    public function item_details(): BelongsTo
    {
        return $this->BelongsTo(Items::class);
    }
}
