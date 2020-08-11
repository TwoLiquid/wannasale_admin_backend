<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Http\Controllers\Dashboard\BaseController;
use App\Repositories\RequestRepository;
use App\Http\Controllers\Controller;

class RequestController extends BaseController
{
    public function index(
        RequestRepository $requestRepo
    )
    {
        $requests = $requestRepo->getByPartner(
            $this->getAdmin()
        );

        return view('dashboard.partner.requests.index', [
            'items' => $requests
        ]);
    }
}
