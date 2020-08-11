<?php

use App\Models\Request;

return [

    /*
    |--------------------------------------------------------------------------
    | Request Language Lines
    |--------------------------------------------------------------------------
    */

    'status' => [
        Request::STATUS_NEW => 'Новый',
        Request::STATUS_WAITING_FOR_CLIENT => 'В работе (ожидает ответа клиента)',
        Request::STATUS_WAITING_FOR_OPERATOR => 'В работе (ожидает ответа оператора)',
        Request::STATUS_CLOSED_SUCCESS => 'Закрыт (успешно)',
        Request::STATUS_CLOSED_FAILURE => 'Закрыт (неуспешно)',
    ]

];
