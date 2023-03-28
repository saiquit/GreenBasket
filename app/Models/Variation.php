<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Variation extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the product that owns the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the stock associated with the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    /**
     * Get the price associated with the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function price(): HasOne
    {
        return $this->hasOne(Price::class);
    }

    /**
     * The orderedProducts  that belong to the Variation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot(['qty', 'wt'])->withTimestamps();
    }
}
