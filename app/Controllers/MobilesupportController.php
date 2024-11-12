<?php

namespace App\Controllers;

use App\Controllers\Base\BaseController;

class MobilesupportController extends BaseController
{
    public function index()
    {
        return view("mobile/mobilesupport");
    }
}