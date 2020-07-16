<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\JasaInstallasi;
use App\JasaPrint;
use App\PeminjamanAlat;
use App\PeminjamanLab;
use App\SuratBebasLabkom;
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
            'PeminjamanAlat' => count(PeminjamanAlat::all()),
            'SuratBebasLabkom' => count(SuratBebasLabkom::all()),
            'JasaPrint' => count(JasaPrint::all()),
            'JasaInstallasi' => count(JasaInstallasi::all()),
        ];
        return view('Home.home', $data);
    }
}
