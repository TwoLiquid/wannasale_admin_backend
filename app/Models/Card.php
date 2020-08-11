<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Card
 *
 * @property string $id
 * @property string $vendor_id
 * @property string $number
 * @property string $name
 * @property string $month
 * @property string $year
 * @property string|null $token
 * @property int $default
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read \App\Models\Vendor $vendor
 * @mixin \Eloquent
 */
class Card extends Model
{
    use HasUuid;

    protected $connection = 'main';

    protected $table = 'cards';

    protected $fillable = [
        'vendor_id', 'name', 'number', 'month', 'year',
        'token', 'account_id', 'default'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}
