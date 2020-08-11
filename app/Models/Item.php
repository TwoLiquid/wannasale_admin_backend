<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @property string $id
 * @property string $site_id
 * @property string|null $name
 * @property string|null $code
 * @property array $urls
 * @property int|null $initial_price
 * @property int|null $min_acceptable_price
 * @property int|null $min_unacceptable_price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Site $site
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasUuid;

    protected $connection = 'main';

    protected $table = 'items';

    protected $fillable = [
        'site_id', 'name', 'code', 'urls', 'initial_price',
        'min_acceptable_price', 'min_unacceptable_price'
    ];

    protected $casts = [
        'urls' => 'array'
    ];

    //--------------------------------------------------------------------------
    // Relations

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
