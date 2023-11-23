<?php

namespace App\Http\Livewire;

use App\Models\player;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Playerlivewire extends Component
{
    public $deleteId = '';
    public $players;
    public $repForTeam = '';
    public string $name = '';
    public string $pCardId = '';
    public string $position = '';

    public string $nationalNum = '';
    public string $birthDate = '';
    public string $height = '';
    public string $speed = '';
    // this var for storing the id to use in the edit function
    public string $strongFoot = '';
    public string $weight = '';

    public string $health = '';
    public bool $status = true;
    public string $team = '';
    public $Editloaded = false;

    public $loaded = false;

    public $closeModel = false;


    protected $rules = [
        'name' => ['required', 'min:2'],
        'pCardId' => ['required'],
        'nationalNum' => ['required', 'min:12', 'max:12'],
        'birthDate' => ['required'],
        'height' => ['required', 'min:2'],
        'speed' => ['required'],
        'strongFoot' => ['required'],
    ];

    public function mount()
    {
        $this->selectplayers();
    }

    public function selectplayers()
    {
        try {

            $this->players = player::orderBy('created_at', 'DESC')->get();
        } catch (\Throwable $th) {
            session()->flash('message', 'الرجاء التأكد من البيانات');
        }
    }

    public function lodemodel()
    {
        $this->loaded = true;
        $this->closeModel = false;

    }

    public function render()
    {

        $user = Auth::user();
        if ($user->role != 'superadmin') {
            $guys = player::where('team', $user->repForTeam)->get();
        } else {
            $guys = player::all();
        }

        return view('livewire.playerlivewire', [
            'guys' => $guys,

        ]);
    }

    public function toggleplayer($id)
    {
        $players = player::where('id', $id)->first();
        if (!$players) {
            return;
        }
        try {

            $players->status = !$players->status;
            $players->save();
        } catch (\Throwable $th) {
            $this->ex = $th;
        }
        $this->selectplayers();

    }


    public function lodeEditmodel($id)
    {
        $player = player::where('id', $id)->first();
        $this->name = $player->name;
        $this->position = $player->position;
        $this->nationalNum = $player->nationalNum;
        $this->birthDate = $player->birthDate;
        $this->height = $player->height;
        $this->speed = $player->speed;
        $this->strongFoot = $player->strongFoot;
        $this->health = $player->health;
        $this->team = $player->team;
        $this->weight = $player->weight;
        $this->pCardId = $player->pCardId;
        $this->position = $player->position;

        $this->edit_id = $id;
        $this->Editloaded = true;
        $this->closeModel = false;

    }

    public function addplayer()
    {
        $this->validate();
        //  $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');
        // $this->userId = Auth::user()->id;
        $user = Auth::user();


        if ($this->team == '') {
            $this->team = $user->repForTeam;
        }
        // try {

        $player = new player();
        $player->pCardId = $this->pCardId;
        $player->name = $this->name;
        $player->position = $this->position;
        $player->nationalNum = $this->nationalNum;
        $player->birthDate = $this->birthDate;
        $player->height = $this->height;
        $player->speed = $this->speed;
        $player->strongFoot = $this->strongFoot;
        $player->health = $this->health;
        $player->team = $this->team;
        $player->weight = $this->weight;
        $player->position = $this->position;

        $player->status = true;

        $player->save();
        $this->closeModel = true;

        // $project_user = new project_user();
        // $project_user->project_id = $projects->id;
        // $project_user->user_id = $this->userId;



        // $project_user->save();
        session()->flash('message', 'تمت اضافة العنصر بنجاح');

        // }catch (\Throwable $th) {
        //     $this-> propertyReset();
        //     session()->flash('error', 'الرجاء التأكد من البيانات');
        // }
        $this->propertyReset();
        $this->selectplayers();

        $this->loaded = false;
    }


    public function editplayer($id)
    {
        // dd($id);

        $player = player::where('id', $id)->first();
        if (!$player) {
            return;
        } else {
            $this->validate();
            //  $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');
            $user = Auth::user();


            if ($this->team == '') {
                $this->team = $user->repForTeam;
            }
            // try {
            $player->pCardId = $this->pCardId;

            $player->pCardId = $this->pCardId;
            $player->name = $this->name;
            $player->nationalNum = $this->nationalNum;
            $player->birthDate = $this->birthDate;
            $player->height = $this->height;
            $player->speed = $this->speed;
            $player->strongFoot = $this->strongFoot;
            $player->health = $this->health;
            $player->team = $this->team;
            $player->weight = $this->weight;
            $player->position = $this->position;


            $player->save();
            // $this->closeModel =true;

            // $project_user = project::where('project_id', $id)->where('user_id', $$this->userId)->first();    
            // $project_user->project_id = $projects->id;
            // $project_user->user_id = $this->userId;



            // $project_user->save();
            session()->flash('message', 'تمت تعديل العنصر بنجاح');

            $this->propertyReset();
            // }catch (\Throwable $th) {
            //     $this->propertyReset();

            //     session()->flash('error', 'الرجاء التأكد من البيانات');
            // }

            $this->Editloaded = false;
            $this->selectplayers();

        }
    }

    public function delete($id)
    {
        $player = player::where('id', $id)->first();
        if (!$player) {
            return;
        } else {
            // try {

            $player->delete();
            session()->flash('message', 'تمت حذف العنصر بنجاح');


            // }catch (\Throwable $th) {
            //     session()->flash('error', 'الرجاء التأكد من حذف المهام المتعلقة بالمشروع قبل محو المشروع');
            // }
            $this->propertyReset();
            $this->selectplayers();

        }
    }

    public function propertyReset()
    {

        $this->reset('name', 'position', 'pCardId', 'nationalNum', 'birthDate', 'height', 'weight', 'speed', 'strongFoot', 'health', 'status', 'team');

    }
}