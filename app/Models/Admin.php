<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Admin
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $email_confirmation_code
 * @property bool $approved
 * @property bool $is_super
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 */
class Admin extends Authenticatable
{
    use Notifiable;
    use HasUuid;
    use SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'password', 'email_confirmation_code',
        'approved', 'is_super'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'is_super' => 'boolean'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function vendors()
    {
        return $this->hasMany(AdminVendor::class);
    }
}
