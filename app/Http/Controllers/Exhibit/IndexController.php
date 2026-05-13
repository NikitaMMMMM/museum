<?php

namespace App\Http\Controllers\Exhibit;

use App\Models\Exhibit;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $exhibits = Exhibit::paginate(10);

        return view('exhibits.index', compact('exhibits'));
    }
}
