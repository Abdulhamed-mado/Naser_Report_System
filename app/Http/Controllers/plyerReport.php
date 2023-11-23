<?php

namespace App\Http\Controllers;

use App\Models\player;
use App\Models\playerPreformance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class plyerReport extends Controller
{




    public $current_month;
    public $current_year;
    public $report_month;

    public function report($id, $month)
    {
        $this->report_month = $month;


        $year = Carbon::now()->year;
        $month = Carbon::now()->setMonth($month)->setYear($year)->startOfMonth();

        $this->current_month = $month->locale("ar_SA")->translatedFormat("F");


        $this->current_year = date('Y');
        $player = player::find($id);
        $report = playerPreformance::where('player_id', $player->id)
            ->where('report_month', $this->report_month)
            ->groupBy('id')
            ->get();

        // dd($this->report_month);
        $attendanceAverage = $report->avg('attendance');
        $performanceAverage = $report->avg('preformances');
        $attendanceAverageGrade = '';
        $performanceAverageGrade = '';


        if ($attendanceAverage >= 0 && $attendanceAverage >= 1) {
            $attendanceAverageGrade = 'ضعيف';
        } elseif ($attendanceAverage > 1 && $attendanceAverage >= 2) {
            $attendanceAverageGrade = 'متوسط';
        } elseif ($attendanceAverage > 2 && $attendanceAverage >= 3) {
            $attendanceAverageGrade = 'ممتاز';
        }

        if ($performanceAverage >= 0 && $performanceAverage >= 1) {
            $performanceAverageGrade = 'ضعيف';
        } elseif ($performanceAverage > 1 && $performanceAverage >= 2) {
            $performanceAverageGrade = 'متوسط';
        } elseif ($performanceAverage > 2 && $performanceAverage >= 3) {
            $performanceAverageGrade = 'ممتاز';
        }

        // dd($director);

        return view('playerAllMonthReport', [

            'player' => $player,
            'reports' => $report,
            'current_year' => $this->current_year,
            'current_month' => $this->current_month,
            'attendance' => $attendanceAverageGrade,
            'preformances' => $performanceAverageGrade,

        ]);


    }

    public function reportMonth($id, $month)
    {
        $this->report_month = $month;


        $year = Carbon::now()->year;
        $month = Carbon::now()->setMonth($month)->setYear($year)->startOfMonth();

        $this->current_month = $month->locale("ar_SA")->translatedFormat("F");


        $this->current_year = date('Y');
        $player = player::find($id);
        $report = playerPreformance::where('player_id', $player->id)
            ->where('report_month', $this->report_month)
            ->groupBy('id')
            ->get();


        $attendanceAverage = $report->avg('attendance');
        $performanceAverage = $report->avg('preformances');
        $attendanceAverageGrade = '';
        $performanceAverageGrade = '';


        if ($attendanceAverage >= 0 && $attendanceAverage >= 1) {
            $attendanceAverageGrade = 'ضعيف';
        } elseif ($attendanceAverage > 1 && $attendanceAverage >= 2) {
            $attendanceAverageGrade = 'متوسط';
        } elseif ($attendanceAverage > 2 && $attendanceAverage >= 3) {
            $attendanceAverageGrade = 'ممتاز';
        }

        if ($performanceAverage >= 0 && $performanceAverage >= 1) {
            $performanceAverageGrade = 'ضعيف';
        } elseif ($performanceAverage > 1 && $performanceAverage >= 2) {
            $performanceAverageGrade = 'متوسط';
        } elseif ($performanceAverage > 2 && $performanceAverage >= 3) {
            $performanceAverageGrade = 'ممتاز';
        }

        return view('playerReport', [

            'player' => $player,
            'current_year' => $this->current_year,
            'current_month' => $this->current_month,
            'month' => $this->report_month,
            'attendance' => $attendanceAverageGrade,
            'preformances' => $performanceAverageGrade,


        ]);


    }





}
