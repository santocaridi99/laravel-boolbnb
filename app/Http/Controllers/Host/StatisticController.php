<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Statistic;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::all();
        $apartments = Apartment::where("user_id", Auth::user()->id);
        return view('host.stats.index', compact('apartments', 'statistics'));
    }
}
