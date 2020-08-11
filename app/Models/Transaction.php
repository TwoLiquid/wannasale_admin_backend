<?php

namespace App\Models;

use App\Support\Models\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUuid;

    protected $connection = 'main';

    protected $table = 'transactions';

    protected $fillable = [
        'subscription_id',
        'is_successful',
        'ext_id',
        'amount', 'currency',
        'card_type', 'card_last_digits', 'card_exp_month', 'card_exp_year', 'card_token',
        'status_code', 'status', 'reason', 'message'
    ];

    protected $casts = [
        'is_successful'     => 'boolean',
        'card_exp_month'    => 'integer',
        'card_exp_year'     => 'integer',
        'status_code'       => 'integer'
    ];

    protected $hidden = [
        'card_token'
    ];

    //--------------------------------------------------------------------------
    // Relations

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
