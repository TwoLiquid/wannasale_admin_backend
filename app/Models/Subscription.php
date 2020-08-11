<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscription
 *
 * @property string $id
 * @property string $vendor_id
 * @property string $rate_id
 * @property string|null $card_id
 * @property int|null $price
 * @property string|null $currency
 * @property bool $active
 * @property bool $trial
 * @property \Carbon\Carbon|null $started_at
 * @property \Carbon\Carbon|null $finish_at
 * @property \Carbon\Carbon|null $next_transaction_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Card|null $card
 * @property-read \App\Models\Rate $rate
 * @property-read \App\Models\Vendor $vendor
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use HasUuid;

    protected $connection = 'main';

    protected $table = 'subscriptions';

    protected $fillable = [
        'vendor_id', 'rate_id', 'card_id', 'price', 'currency', 'active',
        'started_at', 'trial', 'finish_at', 'next_transaction_at'
    ];

    protected $casts = [
        'active'    => 'boolean',
        'trial'     => 'boolean'
    ];

    protected $dates = [
        'started_at',
        'trial_finish_at',
        'finish_at',
        'next_transaction_at'
    ];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
