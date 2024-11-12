<?php

namespace App\Controllers;

use App\Controllers\Base\BaseController;

class MobilebantuanController extends BaseController
{
    public function index()
    {
        return view("mobile/mobilebantuan");
    }
}