<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\workout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WorkoutLivewire extends Component
{
    public string $report_month = '';
    public string $report_week = '';

    public string $report_date = '';
    public string $plan = '';
    public string $user_id = '';

    public string $couch_id = '';


    public string $team = '';

    public $loaded = false;
    public $Editloaded = false;
    public $reportloaded = false;

    public $closeModel = false;
    public string $edit_id = '';


    protected $rules = [
        'report_date' => ['required'],
        'report_month' => ['required'],
        'report_week' => ['required'],
        'plan' => ['required'],



    ];

    public function render()
    {
        $user = Auth::user();





        if ($user->role != 'superadmin') {
            $reports = workout::where('user_id', $user->id)->get();
            $couches = User::where('role', 'مدرب')->where('repForTeam', $user->repForTeam)->get();




        } else {
            $reports = workout::all();
            $couches = User::where('role', 'مدرب')->get();


        }


        $playerData = [];

        foreach ($reports as $report) {
            $couche = User::find($report->couch_id);



            $playerData[] = [
                'id' => $report->id,
                'couch_id' => $couche->couch_id,

                'couch_name' => $couche->name,

                'report_month' => $report->report_month,
                'plan' => $report->plan,
                'report_week' => $report->report_week,
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

        return view('livewire.workout-livewire', [
            'reports' => $playerData,
            'couches' => $couches,
        ]);
    }

    public function mount()
    {
        $this->selectreport();
    }


    public function selectreport()
    {
        try {

            $this->tasks = workout::orderBy('created_at', 'DESC')->get();
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
        $report = workout::where('id', $id)->first();
        $this->couch_id = $report->couch_id;
        $this->report_date = $report->report_date;
        $this->report_month = $report->report_month;
        $this->report_week = $report->report_week;
        $this->plan = $report->plan;


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
        $this->reset('couch_id', 'user_id', 'report_date', 'report_month', 'report_week', 'team', 'plan');

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

        if ($this->couch_id == '') {
            $this->couch_id = $user->id;
        }

        if ($this->team == '') {
            $this->team = $user->repForTeam;
        }
        try {



            // dd($this->task_month);
            $report = new workout();

            $report->couch_id = $this->couch_id;
            $report->report_date = $this->report_date;
            $report->report_month = $this->report_month;
            $report->report_week = $this->report_week;
            $report->plan = $this->plan;
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
        $this->selectreport();


    }



    public function editreport($id)
    {
        $report = workout::where('id', $id)->first();
        if (!$report) {
            return;
        } else {
            $this->validate();


            $user = Auth::user();
            // $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');
            if ($this->couch_id == '') {
                $this->couch_id = $user->id;
            }

            if ($this->team == '') {
                $this->team = $user->repForTeam;
            }
            try {



                // dd($this->task_month);

                $report->couch_id = $this->couch_id;
                $report->report_date = $this->report_date;
                $report->report_month = $this->report_month;
                $report->report_week = $this->report_week;
                $report->plan = $this->plan;
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
        $report = workout::where('id', $id)->first();
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




    public function report($team, $month, $week)
    {


        return redirect('/workoutplan/' . $team . '/' . $month . '/' . $week);

    }
}
