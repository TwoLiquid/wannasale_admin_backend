<?php

namespace App\Models\Presenters;

trait RequestPresenter
{
    public function getPrettyStatusAttribute() : string
    {
        return trans('models/request.status.' . $this->status);
    }
}
