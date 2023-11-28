<?php

namespace App\Http\Controllers;

use App\Models\logustic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logisticReport extends Controller
{
    public $current_month;
    public $current_year;
    public $order_month;

    public function report($id, $month)
    {
        $this->order_month = $month;


        $year = Carbon::now()->year;
        $month = Carbon::now()->setMonth($month)->setYear($year)->startOfMonth();

        $this->current_month = $month->locale("ar_SA")->translatedFormat("F");


        $this->current_year = date('Y');
        $logustic = logustic::where('order_month', $this->order_month)
            ->groupBy('id')
            ->get();

        // dd($this->report_month);


        // dd($director);

        return view('logisticReport', [

            'logustics' => $logustic,


        ]);


    }
}
