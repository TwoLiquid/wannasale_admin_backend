<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Client
 *
 * @property string $id
 * @property string $vendor_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Vendor $vendor
 * @mixin \Eloquent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
class Client extends Model
{
    use Notifiable;
    use HasUuid;

    protected $connection = 'main';

    protected $table = 'clients';

    protected $fillable = [
        'vendor_id', 'name', 'email', 'phone'
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
}
