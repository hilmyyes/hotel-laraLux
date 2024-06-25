<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    // tujuan nya adalah untuk ngambil data hotel pada database karena hotel 1:n product, maka kita gunakan belongsTo
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id'); // hotel_id untuk merujuk pada id hotel yang akan di tuju
    }

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class, 'Product_transaction', 'product_id', 'transaction_id')->withPivot('checkin_date', 'duration', 'subtotal'); // hotel_id untuk merujuk pada id hotel yang akan di tuju
    }
}
