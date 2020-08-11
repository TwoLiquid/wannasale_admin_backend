<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Routing\Tests\Fixtures\OtherAnnotatedClasses\AnonymousClassInTrait;

/**
 * App\Models\AdminVendor
 *
 * @property string $id
 * @property string $admin_id
 * @property string $vendor_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Admin $admin
 * @property-read \App\Models\Vendor $vendor
 * @mixin \Eloquent
 */
class AdminVendor extends Model
{
    use HasUuid;

    protected $table = 'admins_vendors';

    protected $fillable = [
        'admin_id', 'vendor_id'
    ];

    //--------------------------------------------------------------------------
    // Relations

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function requests()
    {
        return $this->hasManyThrough('App\Models\Request', 'App\Models\Vendor');
    }
}
