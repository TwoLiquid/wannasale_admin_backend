<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rate
 *
 * @property string $id
 * @property string|null $name
 * @property int|null $price
 * @property bool $default
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @mixin \Eloquent
 */
class Rate extends Model
{
    use HasUuid;

    protected $connection = 'main';

    protected $table = 'rates';

    protected $fillable = [
        'name', 'price', 'default'
    ];

    protected $casts = [
        'default'   => 'boolean'
    ];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->HasMany(Subscription::class);
    }
}
