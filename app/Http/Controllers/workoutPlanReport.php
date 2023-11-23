<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\workout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class workoutPlanReport extends Controller
{



    public $current_month;
    public $current_year;
    public $report_month;
    public $report_week;
    public $team;


    public function report($team, $month, $week)
    {
        $this->report_month = $month;
        $this->report_week = $week;


        $year = Carbon::now()->year;
        $month = Carbon::now()->setMonth($month)->setYear($year)->startOfMonth();

        $this->current_month = $month->locale("ar_SA")->translatedFormat("F");


        $this->current_year = date('Y');
        $plan = workout::where('team', $team)
            ->where('report_month', $this->report_month)
            ->where('report_week', $this->report_week)
            ->groupBy('id')
            ->first();

        $couch = User::where('repForTeam', $team)
            ->where('role', 'مدرب')->first();

        // dd($director);
        // dd($couch);

        // dd($plan);
        return view('workoutPlanReport', [


            'couch' => $couch,
            'plan' => $plan,
            'current_year' => $this->current_year,
            'current_month' => $this->current_month,

        ]);


    }
}
