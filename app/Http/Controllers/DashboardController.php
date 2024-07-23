<?php

namespace App\Http\Controllers;
use App\Helpers\ChartsHelper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pieConvertion = ChartsHelper::pieConvertion();
        $indicatorData = ChartsHelper::showIndicator();
        return view('dashboard', compact('pieConvertion','indicatorData'));
    }
}
