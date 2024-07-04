<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "hotels"; // ini gunanya untuk overide database agar bisa di baca
    //dan liat di slide


    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'hotel_id', 'id'); // hasmany buat many karena 1 hotel bisa banyak product
    }

    // tujuan nya adalah untuk ngambil data hotel pada database karena hotel 1:n product, maka kita gunakan belongsTo
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id'); // hotel_id untuk merujuk pada id hotel yang akan di tuju
    }

    public function typeWithTrashed(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id')->withTrashed();
    }

}
