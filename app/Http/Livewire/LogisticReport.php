<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\logustic;
use Illuminate\Support\Facades\Auth;

class LogisticReport extends Component
{
    public string $name = '';
    public string $type = '';

    public string $team = '';
    public string $plan = '';
    public string $order_date = '';

    public string $order_month = '';


    public string $note = '';

    public $loaded = false;
    public $Editloaded = false;
    public $reportloaded = false;

    public $closeModel = false;
    public string $edit_id = '';


    protected $rules = [
        'name' => ['required'],
        'type' => ['required'],
        'order_date' => ['required'],
        'order_month' => ['required'],
        'note' => ['required'],



    ];

    public function render()
    {






        $logustics = logustic::all();





        return view('livewire.logistic-report', [
            'logustics' => $logustics,
        ]);
    }

    public function mount()
    {
        $this->selectreport();
    }


    public function selectreport()
    {
        try {

            $this->tasks = logustic::orderBy('created_at', 'DESC')->get();
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
        $report = logustic::where('id', $id)->first();
        $this->name = $report->name;
        $this->type = $report->type;
        $this->order_date = $report->order_date;
        $this->order_month = $report->order_month;
        $this->note = $report->note;


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
        $this->reset('note', 'order_month', 'order_date', 'team', 'type', 'name');

    }



    public function addreport()
    {

        // dd($this->preformances);
        // $this->report_month = Carbon::now()->toDateString();

        // $this->validate();
        //  $year = Carbon::now()->year;


        // $date = Carbon::createFromFormat('mm/dd/yyyy', $this->report_date)->format('Y-m-d');
        // dd($date);

        try {



            // dd($this->task_month);
            $logustic = new logustic();

            $logustic->name = $this->name;
            $logustic->type = $this->type;
            $logustic->order_date = $this->order_date;
            $logustic->order_month = $this->order_month;
            $logustic->note = $this->note;
            $logustic->team = $this->team;



            $logustic->save();
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
        $logustic = logustic::where('id', $id)->first();
        if (!$logustic) {
            return;
        } else {
            $this->validate();



            try {



                // dd($this->task_month);

                $logustic->name = $this->name;
                $logustic->type = $this->type;
                $logustic->order_date = $this->order_date;
                $logustic->order_month = $this->order_month;
                $logustic->note = $this->note;
                $logustic->team = $this->team;




                $logustic->update();
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
        $logustic = logustic::where('id', $id)->first();
        if (!$logustic) {
            return;
        } else {
            try {
                $this->User = Auth::user();

                $logustic->delete();

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

