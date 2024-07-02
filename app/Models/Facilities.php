<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facilities extends Model
{
    use HasFactory;

    protected $table = "facilities";

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_has_facilities');
    }


}
