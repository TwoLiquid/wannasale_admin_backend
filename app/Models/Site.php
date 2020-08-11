<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Site
 *
 * @property string $id
 * @property string $vendor_id
 * @property string|null $name
 * @property array $urls
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Models\Vendor $vendor
 * @method bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Site onlyTrashed()
 * @method bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Site withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Site withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Request[] $requests
 * @property-read \App\Models\Widget $widget
 */
class Site extends Model
{
    use HasUuid;
    use SoftDeletes;

    protected $connection = 'main';

    protected $table = 'sites';

    protected $fillable = [
        'vendor_id', 'name', 'urls'
    ];

    protected $casts = [
        'urls' => 'array'
    ];

    protected $dates = ['deleted_at'];

    //--------------------------------------------------------------------------
    // Relations

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function widget()
    {
        return $this->hasOne(Widget::class);
    }
}
