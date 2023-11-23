<?php

namespace App\Http\Livewire;

use App\Models\player;
use App\Models\playerPreformance;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PlayerPreformances extends Component
{

    public string $report_month = '';

    public string $report_date = '';
    public string $user_id = '';

    public string $player_id = '';
    public string $attendance = '';
    public string $preformances = '';

    public string $team = '';

    public $loaded = false;
    public $Editloaded = false;
    public $reportloaded = false;

    public $closeModel = false;
    public string $edit_id = '';


    protected $rules = [
        'player_id' => ['required'],
        'report_date' => ['required'],
        'report_month' => ['required'],
        'attendance' => ['required'],



    ];

    public function render()
    {
        $attendanceGrade = '';
        $performanceGrade = '';
        $user = Auth::user();
        $couches = User::where('role', 'مدرب')->get();





        if ($user->role != 'superadmin') {
            $reports = playerPreformance::where('user_id', $user->id)->get();
            $guys = player::where('team', $user->repForTeam);







            $playerData = [];

            foreach ($reports as $report) {


                if ($report->attendance >= 0 && $report->attendance >= 1) {
                    $attendanceGrade = 'ضعيف';
                } elseif ($report->attendance > 1 && $report->attendance >= 2) {
                    $attendanceGrade = 'متوسط';
                } elseif ($report->attendance > 2 && $report->attendance >= 3) {
                    $attendanceGrade = 'ممتاز';
                }

                if ($report->performance >= 0 && $report->performance >= 1) {
                    $performanceGrade = 'ضعيف';
                } elseif ($report->performance > 1 && $report->performance >= 2) {
                    $performanceGrade = 'متوسط';
                } elseif ($report->performance > 2 && $report->performance >= 3) {
                    $performanceGrade = 'ممتاز';
                }

                $player = Player::find($report->player_id);
                $couche = User::find($report->user_id);

                $playerData[] = [
                    'id' => $report->id,
                    'player_id' => $report->player_id,
                    'player_name' => $player->name,
                    'couch_id' => $couche->user_id,
                    'couch_name' => $couche->name,
                    'performance' => $performanceGrade,
                    'attendance' => $attendanceGrade,
                    'team' => $report->team,
                ];
            }


        } else {
            $reports = playerPreformance::all();
            $guys = player::all();

            $playerData = [];

            foreach ($reports as $report) {


                if ($report->attendance >= 0 && $report->attendance >= 1) {
                    $attendanceGrade = 'ضعيف';
                } elseif ($report->attendance > 1 && $report->attendance >= 2) {
                    $attendanceGrade = 'متوسط';
                } elseif ($report->attendance > 2 && $report->attendance >= 3) {
                    $attendanceGrade = 'ممتاز';
                }

                if ($report->preformances >= 0 && $report->preformances >= 1) {
                    $performanceGrade = 'ضعيف';
                } elseif ($report->preformances > 1 && $report->preformances >= 2) {
                    $performanceGrade = 'متوسط';
                } elseif ($report->preformances > 2 && $report->preformances >= 3) {
                    $performanceGrade = 'ممتاز';
                }


                $player = Player::find($report->player_id);
                $couche = User::find($report->user_id);


                $playerData[] = [
                    'id' => $report->id,
                    'player_id' => $report->player_id,
                    'player_name' => $player->name,
                    'couch_id' => $couche->user_id,
                    'couch_name' => $couche->name,
                    'performanceGrade' => $performanceGrade,
                    'attendance' => $attendanceGrade,
                    'team' => $report->team,
                ];
            }
        }

        // if ($this->searchCost) {
        //     $query->where('name', '>=', $this->searchCost);   
        // }


        // if ($this->searchID) {
        //     $query->where('id', $this->searchID);  
        // }

        // if ($this->search) {
        //     $query->where('role', 'like', "%{$this->search}%")
        //     ->orWhere('degree', 'like', "%{$this->search}%")
        //     ;
        // }

        return view('livewire.player-preformances', [
            'reports' => $playerData,
            'couches' => $couches,
            'guys' => $guys,
        ]);
    }

    public function mount()
    {
        $this->selectreport();
    }


    public function selectreport()
    {
        try {

            $this->tasks = playerPreformance::orderBy('created_at', 'DESC')->get();
        } catch (\Throwable $th) {
            session()->flash('error', 'الرجاء التأكد من البيانات');
        }
    }


    public function lodemodel()
    {
        $this->loaded = true;
        $this->closeModel = false;

    }



    public function lodeEditmodel($id)
    {
        $report = playerPreformance::where('id', $id)->first();
        $this->player_id = $report->player_id;
        $this->user_id = $report->user_id;
        $this->report_date = $report->report_date;
        $this->report_month = $report->report_month;
        $this->attendance = $report->attendance;
        $this->preformances = $report->preformances;

        $this->team = $report->team;

        $this->edit_id = $id;

        $this->Editloaded = true;
        $this->closeModel = false;

    }


    public function lodereportmodel()
    {
        $this->reportloaded = true;
        $this->closeModel = false;

    }

    public function propertyReset()
    {
        $this->reset('player_id', 'user_id', 'report_date', 'report_month', 'attendance', 'team', 'preformances');

    }



    public function addreport()
    {

        // dd($this->preformances);
        // $this->report_month = Carbon::now()->toDateString();

        // $this->validate();
        //  $year = Carbon::now()->year;


        // $date = Carbon::createFromFormat('mm/dd/yyyy', $this->report_date)->format('Y-m-d');
        // dd($date);
        $user = Auth::user();

        if ($this->user_id == '') {
            $this->user_id = $user->id;
        }

        if ($this->team == '') {
            $this->team = $user->repForTeam;
        }
        // try {



        // dd($this->task_month);
        $report = new playerPreformance();

        $report->player_id = $this->player_id;
        $report->user_id = $this->user_id;
        $report->report_date = $this->report_date;
        $report->report_month = $this->report_month;
        $report->attendance = $this->attendance;
        $report->preformances = $this->preformances;
        $report->team = $this->team;



        $report->save();
        // $this->closeModel = true;

        // $project_user = new project_user();
        // $project_user->project_id = $projects->id;
        // $project_user->user_id = $this->userId;


        // $project_user->save();
        // $this->propertyReset();

        session()->flash('message', 'تمت اضافة العنصر بنجاح');

        // } catch (\Throwable $th) {
        //     $this->propertyReset();

        //     session()->flash('error', 'الرجاء التأكد من البيانات');

        // }
        // $this->loaded = false;
        // $this->selecttasks();


    }



    public function editreport($id)
    {
        $report = playerPreformance::where('id', $id)->first();
        if (!$report) {
            return;
        } else {
            $this->validate();


            $user = Auth::user();
            // $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');

            if ($this->user_id == '') {
                $this->user_id = $user->id;
            }

            if ($this->team == '') {
                $this->team = $user->repForTeam;
            }

            try {




                $report->player_id = $this->player_id;
                $report->user_id = $this->user_id;
                $report->report_date = $this->report_date;
                $report->report_month = $this->report_month;
                $report->attendance = $this->attendance;
                $report->preformances = $this->preformances;
                $report->team = $this->team;

                $report->update();
                $this->closeModel = true;

                //    $tasks->user()->updateExistingPivot($this->user->id);
                // $project_user = new project_user();
                // $project_user->project_id = $projects->id;
                // $project_user->user_id = $this->userId;



                // $project_user->save();
                session()->flash('message', 'تمت تعديل العنصر بنجاح');
                $this->propertyReset();

            } catch (\Throwable $th) {
                $this->propertyReset();

                session()->flash('error', 'الرجاء التأكد من البيانات');
            }
            $this->Editloaded = false;
            $this->selectreport();



        }




    }

    public function deletereport($id)
    {
        $report = playerPreformance::where('id', $id)->first();
        if (!$report) {
            return;
        } else {
            try {
                $this->User = Auth::user();

                $report->delete();

                session()->flash('message', 'تمت حذف العنصر بنجاح');

            } catch (\Throwable $th) {
                session()->flash('error', 'الرجاء التأكد من البيانات');
            }
            $this->selectreport();
        }
    }


    public function report($id, $month)
    {
        // $validator = Validator::make([
//         'id' => $this->User_id,
//         'month' => $this->month
//     ], [
//         'id' => 'required|integer',
//         'month' => 'required|date_format:m'
//     ]);

        //     if ($validator->fails()) {
//         // Handle validation errors
//         return redirect()->back()->withErrors($validator);
//     }
// $this->validate();


        return redirect('/report/' . $id . '/' . $month);

    }

    public function reportmonth($id, $month)
    {
        // $validator = Validator::make([
//         'id' => $this->User_id,
//         'month' => $this->month
//     ], [
//         'id' => 'required|integer',
//         'month' => 'required|date_format:m'
//     ]);

        //     if ($validator->fails()) {
//         // Handle validation errors
//         return redirect()->back()->withErrors($validator);
//     }
// $this->validate();


        return redirect('/reportmonth/' . $id . '/' . $month);

    }


}