<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property string $id
 * @property string|null $name
 * @property string $email
 * @property string|null $password
 * @property bool $approved
 * @property string|null $email_confirmation_code
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vendor[] $vendors
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasUuid;
    use SoftDeletes;
    use UserPresenter;

    protected $connection = 'main';

    protected $fillable = [
        'name', 'email', 'password',
        'approved', 'email_confirmation_code'
    ];

    protected $hidden = [
        'password', 'remember_token', 'approved'
    ];

    protected $casts = [
        'approved' => 'boolean'
    ];

    protected $dates = ['deleted_at'];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'user_vendor')
            ->withTimestamps()
            ->orderBy('user_vendor.created_at', 'desc');
    }
}
