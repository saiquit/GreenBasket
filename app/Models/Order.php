<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->where('type', 'customer');
    }

    /**
     * The variations that belong to the OrderedProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(Variation::class)->withPivot(['qty', 'wt'])->withTimestamps();
    }
}
