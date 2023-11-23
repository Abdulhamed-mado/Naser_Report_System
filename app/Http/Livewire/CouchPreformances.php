<?php

namespace App\Http\Livewire;

use App\Models\player;
use App\Models\couchPreformance;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class couchpreformances extends Component
{

    public string $report_month = '';

    public string $report_date = '';
    public string $user_id = '';

    public string $couch_id = '';
    public string $attendance = '';
    public string $showAttendance = '';
    public string $showpreformances = '';
    public string $preformances = '';

    public string $team = '';

    public $loaded = false;
    public $Editloaded = false;
    public $reportloaded = false;

    public $closeModel = false;
    public string $edit_id = '';


    protected $rules = [
        'couch_id' => ['required'],
        'report_date' => ['required'],
        'report_month' => ['required'],
        'attendance' => ['required'],



    ];

    public function render()
    {
        $user = Auth::user();





        if ($user->role != 'superadmin') {
            $reports = couchPreformance::where('user_id', $user->id)->get();
            $couches = User::where('role', 'مدرب')->where('repForTeam', $user->repForTeam)->get();
            $manegers = User::where('role', 'اداري')->where('repForTeam', $user->repForTeam)->get();




        } else {
            $reports = couchPreformance::all();
            $couches = User::where('role', 'مدرب')->get();
            $manegers = User::where('role', 'اداري')->get();


        }


        $playerData = [];

        foreach ($reports as $report) {
            $couche = User::find($report->couch_id);
            $maneger = User::find($report->user_id);

            switch ($report->preformances) {
                case 1:
                    $this->showPerformance = "سئ";
                    break;
                case 2:
                    $this->showPerformance = "جيد";
                    break;
                case 3:
                    $this->showPerformance = "ممتاز";
                    break;
                default:
                    $this->showPerformance = "Unknown";
                    break;
            }

            switch ($report->attendance) {
                case 1:
                    $this->showAttendance = "سئ";
                    break;
                case 2:
                    $this->showAttendance = "جيد";
                    break;
                case 3:
                    $this->showAttendance = "ممتاز";
                    break;
                default:
                    $this->showAttendance = "Unknown";
                    break;
            }

            $playerData[] = [
                'id' => $report->id,
                'couch_id' => $couche->couch_id,
                'user_id' => $maneger->user_id,
                'user_name' => $maneger->name,
                'couch_name' => $couche->name,
                'performance' => $this->showPerformance,
                'attendance' => $this->showAttendance,
                'team' => $report->team,
            ];
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

        return view('livewire.couch-preformances', [
            'reports' => $playerData,
            'couches' => $couches,
            'manegers' => $manegers,
        ]);
    }

    public function mount()
    {
        $this->selectreport();
    }


    public function selectreport()
    {
        try {

            $this->tasks = couchPreformance::orderBy('created_at', 'DESC')->get();
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
        $report = couchPreformance::where('id', $id)->first();
        $this->couch_id = $report->couch_id;
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
    public function propertyReset()
    {
        $this->reset('couch_id', 'user_id', 'report_date', 'report_month', 'attendance', 'team', 'preformances');

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
        try {



            // dd($this->task_month);
            $report = new couchPreformance();

            $report->couch_id = $this->couch_id;
            $report->user_id = $this->user_id;
            $report->report_date = $this->report_date;
            $report->report_month = $this->report_month;
            $report->attendance = $this->attendance;
            $report->preformances = $this->preformances;
            $report->team = $this->team;



            $report->save();
            $this->closeModel = true;

            // $project_user = new project_user();
            // $project_user->project_id = $projects->id;
            // $project_user->user_id = $this->userId;


            // $project_user->save();
            $this->propertyReset();

            session()->flash('message', 'تمت اضافة العنصر بنجاح');

        } catch (\Throwable $th) {
            $this->propertyReset();

            session()->flash('error', 'الرجاء التأكد من البيانات');

        }
        $this->loaded = false;
        $this->selecttasks();


    }



    public function editreport($id)
    {
        $report = couchPreformance::where('id', $id)->first();
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




                $report->couch_id = $this->couch_id;
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
        $report = couchPreformance::where('id', $id)->first();
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


}