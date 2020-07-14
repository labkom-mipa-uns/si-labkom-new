<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\PeminjamanLab;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Handle the incoming request.
     *
     * @return Application|Factory|View
     */
    public function __invoke()
    {
        $data = [
            'PeminjamanLab' => count(PeminjamanLab::all()),
        ];
        return view('Home.home', $data);
    }
}
