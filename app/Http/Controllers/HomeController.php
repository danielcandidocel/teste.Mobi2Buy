<?php

namespace App\Http\Controllers;

use App\Models\Api\Url;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $urls = Url::cacheFor(15)->paginate(5);

        return view('home', compact('urls'));
    }
}
