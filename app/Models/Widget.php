<?php

namespace App\Models;

use App\Models\Presenters\WidgetPresenter;
use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Widget
 *
 * @property string $id
 * @property string $site_id
 * @property bool $enabled
 * @property bool $on_item_page_only
 * @property int $show_phone
 * @property string $key
 * @property \WidgetDisplaySettings $display_settings
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Models\Site $site
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Widget withoutTrashed()
 * @mixin \Eloquent
 */
class Widget extends Authenticatable
{
    use HasUuid;
    use SoftDeletes;
    use WidgetPresenter;

    protected $connection = 'main';

    protected $table = 'widgets';

    protected $fillable = [
        'site_id', 'enabled', 'on_item_page_only', 'show_phone', 'key', 'display_settings'
    ];

    protected $casts = [
        'enabled'           => 'boolean',
        'on_item_page_only' => 'boolean'
    ];

    protected $dates = ['deleted_at'];

    //--------------------------------------------------------------------------
    // Relations

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
