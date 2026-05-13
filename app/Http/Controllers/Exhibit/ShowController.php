<?php

namespace App\Http\Controllers\Exhibit;

use App\Models\Exhibit;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Exhibit $exhibit)
    {
        return view('exhibits.show', compact('exhibit'));
    }
}
