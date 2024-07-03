<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "transactions";
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'Product_transaction', 'transaction_id', 'product_id')->withPivot('checkin_date', 'duration', 'subtotal'); // hotel_id untuk merujuk pada id hotel yang akan di tuju
    }
}
