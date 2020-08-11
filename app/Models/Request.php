<?php

namespace App\Models;

use App\Models\Presenters\RequestPresenter;
use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Request
 *
 * @property string $id
 * @property string|null $vendor_id
 * @property string|null $site_id
 * @property string|null $widget_id
 * @property string|null $item_id
 * @property string|null $client_id
 * @property string|null $name
 * @property string|null $item_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $url
 * @property string|null $ip
 * @property string|null $cookies
 * @property string|null $user_agent
 * @property int $status
 * @property string|null $country
 * @property string|null $city
 * @property int|null $offered_price
 * @property int|null $total_price
 * @property array $proposals_history
 * @property string|null $currency
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read mixed $pretty_status
 * @property-read \App\Models\Item|null $item
 * @property-read \App\Models\Site|null $site
 * @property-read \App\Models\Vendor|null $vendor
 * @property-read \App\Models\Widget|null $widget
 * @mixin \Eloquent
 */
class Request extends Model
{
    use HasUuid;
    use RequestPresenter;

    protected $connection = 'main';

    protected $table = 'requests';

    protected $fillable = [
        'vendor_id', 'site_id', 'widget_id',
        'item_id', 'item_name',
        'client_id', 'name', 'email', 'phone',
        'offered_price', 'currency',
        'url', 'ip', 'cookies', 'user_agent',
        'status', 'total_price', 'country', 'city',
        'proposals_history'
    ];

    protected $casts = [
        'status' => 'integer',
        'proposals_history' => 'array'
    ];

    const STATUS_NEW = 0;
    const STATUS_WAITING_FOR_CLIENT = 1;
    const STATUS_WAITING_FOR_OPERATOR = 2;
    const STATUS_CLOSED_SUCCESS = 3;
    const STATUS_CLOSED_FAILURE = 4;

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_WAITING_FOR_CLIENT, self::STATUS_WAITING_FOR_OPERATOR,
        self::STATUS_CLOSED_SUCCESS, self::STATUS_CLOSED_FAILURE
    ];

    //--------------------------------------------------------------------------
    // Relations

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

    /* public function messages()
    {
        return $this->hasMany(RequestMessage::class);
    } */
}
