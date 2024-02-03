<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\game;
use App\Models\logustic;

use Illuminate\Support\Facades\Auth;
class MatchLogistic extends Component
{

    public string $team = '';
    public string $matchType = '';
    public string $quantity = '';
    public string $cost = ''; 
    public  $User ;
    public  $game ;
    public string $order_date = '';

    public string $order_month = '';


    public string $note = '';

    public $loaded = false;
    public $Editloaded = false;
    public $reportloaded = false;
    public $reportdetailloaded = false;

    public $closeModel = false;
    public string $edit_id = '';


    protected $rules = [
     
        'quantity' => ['required'],
        'cost' => ['required'],
        'order_date' => ['required'],
        'order_month' => ['required'],
        'matchType' => ['required'],
        'note' => ['required'],



    ];

    public function render()
    {






        $games = game::all();
// dd($games);




        return view('livewire.match-logistic', [
            'games' => $games,
        ]);
    }

    public function mount()
    {
        $this->selectreport();
    }


    public function selectreport()
    {
        try {

            $this->game = game::orderBy('created_at', 'DESC')->get();
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
        $report = game::where('id', $id)->first();
        $this->quantity = $report->quantity;
        $this->order_date = $report->order_date;
        $this->order_month = $report->order_month;
        $this->note = $report->note;
        $this->cost = $report->cost;
        $this->matchType = $report->matchType;


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
    public function lodedetailreportmodel()
    {
        $this->reportdetailloaded = true;
        $this->closeModel = false;

    }

    public function propertyReset()
    {
        $this->reset('note', 'order_month', 'order_date', 'team', 'matchType','quantity' );

    }



    public function addreport()
    {

        // dd($this->preformances);
        // $this->report_month = Carbon::now()->toDateString();

        // $this->validate();
        //  $year = Carbon::now()->year;


        // $date = Carbon::createFromFormat('mm/dd/yyyy', $this->report_date)->format('Y-m-d');
        // dd($date);

        // try {

        $cost = logustic::where('matchType',  $this->matchType)
        ->where('team',$this->team)
        ->where('order_month',$this->order_month)
        ->get();

// dd($cost);
// $costg=$cost->cost;
        $totalCost = $cost->sum('cost')*$this->quantity;
// dd($totalCost);
        
            // dd($this->task_month);
            $game = new game();
            $game->cost = $totalCost;
            $game->quantity = $this->quantity;
            $game->matchType = $this->matchType;
            $game->order_date = $this->order_date;
            $game->order_month = $this->order_month;
            $game->note = $this->note;
            $game->team = $this->team;
            $game->matchType = $this->matchType;



            $game->save();
            $this->closeModel = true;

            // $project_user = new project_user();
            // $project_user->project_id = $projects->id;
            // $project_user->user_id = $this->userId;


            // $project_user->save();
            $this->propertyReset();

            session()->flash('message', 'تمت اضافة العنصر بنجاح');

        // } catch (\Throwable $th) {
        //     $this->propertyReset();
        //         session()->flash('error',  $th);

        //     // session()->flash('error', 'الرجاء التأكد من البيانات');

        // }
        $this->loaded = false;
        $this->selectreport();


    }



    public function editreport($id)
    {
        $game=game::find($id);

        if(!$game){
                            session()->flash('error', 'الرجاء التأكد من البيانات');

        }else{
       try {

    $cost = logustic::where('matchType',  $this->matchType)
        ->where('team',$this->team)
        ->get();

        $totalCost = $cost->sum('cost');


            $game->cost = $totalCost;
            $game->matchType = $this->matchType;
            $game->quantity = $this->quantity;
            $game->order_date = $this->order_date;
            $game->order_month = $this->order_month;
            $game->note = $this->note;
            $game->team = $this->team;
            $game->matchType = $this->matchType;



                $game->update();
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
        $game = game::where('id', $id)->first();
        if (!$game) {
            return;
        } else {
            try {
                $this->User = Auth::user();

                $game->delete();

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
