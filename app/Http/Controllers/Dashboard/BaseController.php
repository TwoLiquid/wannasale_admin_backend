<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Support\Response\ApiResponseTrait;
use App\Support\Response\GeneralResponseTrait;

/**
 * Class BaseController.
 *
 * @package App\Http\Controllers\Api
 */
abstract class BaseController extends Controller
{
    use ApiResponseTrait;
    use GeneralResponseTrait;

    /**
     * @return Admin|null
     */
    public function getAdmin() : ?Admin
    {
        return auth(GUARD_DASHBOARD)->user();
    }
}
