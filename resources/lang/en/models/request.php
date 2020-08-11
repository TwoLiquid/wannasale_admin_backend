<?php

use App\Models\Request;

return [

    /*
    |--------------------------------------------------------------------------
    | Request Language Lines
    |--------------------------------------------------------------------------
    */

    'status' => [
        Request::STATUS_NEW => 'New',
        Request::STATUS_WAITING_FOR_CLIENT => 'In process (Waiting for client)',
        Request::STATUS_WAITING_FOR_OPERATOR => 'In process (Waiting for operator)',
        Request::STATUS_CLOSED_SUCCESS => 'Closed (Success)',
        Request::STATUS_CLOSED_FAILURE => 'Closed (Failure)',
    ]

];
