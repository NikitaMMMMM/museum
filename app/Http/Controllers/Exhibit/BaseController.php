<?php

namespace App\Http\Controllers\Exhibit;

use App\Http\Controllers\Controller;
use App\Service\Auth\RegisterService;

abstract class BaseController extends Controller
{
    public $service;

    public function __construct(RegisterService $service) {
        $this->service = $service;
    }
}
