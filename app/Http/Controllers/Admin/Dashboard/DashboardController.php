<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return InertiaResponse
     */
    public function __invoke(): InertiaResponse
    {
        return Inertia::render('Admin/Dashboard/Index');
    }
}
