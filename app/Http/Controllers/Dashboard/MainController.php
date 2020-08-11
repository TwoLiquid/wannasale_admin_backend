<?php

namespace App\Http\Controllers\Dashboard;

class MainController extends BaseController
{
    public function index()
    {
        if ($this->getAdmin()->is_super == 1) {
            return redirect()->route('dashboard.admin.vendors');
        } else {
            return redirect()->route('dashboard.partner.vendors');
        }
    }
}
