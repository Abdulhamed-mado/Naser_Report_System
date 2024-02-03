<?php

namespace App\Http\Controllers;

use App\Models\logustic;
use App\Models\game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class matchReport extends Controller
{
  public $current_month;
    public $current_year;
    public $order_month;

    public function report($month)
    {
        $this->order_month = $month;


        $year = Carbon::now()->year;
        $month = Carbon::now()->setMonth($month)->setYear($year)->startOfMonth();

        $this->current_month = $month->locale("ar_SA")->translatedFormat("F");


        $this->current_year = date('Y');
        $firstgame = game::where('order_month', $this->order_month)->where('team', 'ناشئين')
            ->groupBy('id')
            ->get();
       $gamecost= $firstgame->sum('cost');
            $secondgame = game::where('order_month', $this->order_month)->where('team', 'براعم')
            ->groupBy('id')
            ->get();
       
       $secondgamecost= $secondgame->sum('cost');


            $thirdgame = game::where('order_month', $this->order_month)->where('team', 'امال')
            ->groupBy('id')
            ->get();
              $thirdgamecost= $thirdgame->sum('cost');

            $forthgame = game::where('order_month', $this->order_month)->where('team', 'اواسط')
            ->groupBy('id')
            ->get();
              $forthgamecost= $forthgame->sum('cost');


            
        // dd($this->report_month);


        // dd($director);

        return view('matchReport', [ 

           
            'gamecost' => $gamecost,
            'secondgamecost' => $secondgamecost,
            'thirdgamecost' => $thirdgamecost,
            'forthgamecost' => $forthgamecost,
            'current_year' => $this->current_year,
            'current_month' => $this->current_month,

        ]);


    }
  
  
   public function detaiReport($team,$month)
    {
        $this->order_month = $month;


        $year = Carbon::now()->year;
        $month = Carbon::now()->setMonth($month)->setYear($year)->startOfMonth();

        $this->current_month = $month->locale("ar_SA")->translatedFormat("F");


        $this->current_year = date('Y');
        $logustics = logustic::where('order_month', $this->order_month)->where('team', $team)
            ->groupBy('id')
            ->get();
           

            
              $firstgame = game::where('order_month', $this->order_month)->where('team', $team)->where('matchType', 'رسمية')
            ->groupBy('id')
            ->get();

            $numInstances = $firstgame->sum('quantity');
// dd($numInstances);

                 $secondgame = game::where('order_month', $this->order_month)->where('team', $team)->where('matchType', 'ودية')
            ->groupBy('id')
            ->get();

            $secondNumInstances = $secondgame->sum('quantity');
        // dd($this->report_month);


        // dd($director);

        return view('detailMatchReport', [ 

           
            'logustics' => $logustics,
            'secondNumInstances' => $secondNumInstances,
            'numInstances' => $numInstances,
            'team'=>$team,
            'current_year' => $this->current_year,
            'current_month' => $this->current_month,

        ]);


    }
  
  
  
  
  }
