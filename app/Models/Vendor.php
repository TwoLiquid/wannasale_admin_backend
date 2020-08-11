<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Vendor
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $slug
 * @property bool $active
 * @property int $site_max
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Card[] $cards
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Request[] $requests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[] $sites
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vendor onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vendor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Vendor withoutTrashed()
 * @mixin \Eloquent
 */
class Vendor extends Model
{
    use HasUuid;
    use SoftDeletes;

    protected $connection = 'main';

    protected $table = 'vendors';

    protected $fillable = [
        'name', 'slug', 'active', 'site_max'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $dates = ['deleted_at'];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vendor')
            ->withTimestamps()
            ->orderBy('user_vendor.created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
