<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Mangementlivewire extends Component
{

    public $Users;
    public $User;
    public $employee;
    public $director;
    public $head;
    public $department;
    public string $searchID = '';
    public $deleteId = '';

    public $repForTeam = '';
    public string $name = '';
    public string $email = '';

    public string $degree = '';
    public string $role = '';
    public string $int_date = '';
    public string $edit_id = '';
    // this var for storing the id to use in the edit function
    public string $password = '';
    public $Editloaded = false;

    public $loaded = false;

    public $closeModel = false;


    public function render()
    {

        // $user=Auth::user();
        $users = User::all();


        return view('livewire.mangementlivewire', [
            'users' => $users


        ]);
    }



    public function mount()
    {
        $this->selectUsers();
    }




    public function lodemodel()
    {
        $this->loaded = true;
        $this->closeModel = false;

    }


    public function lodeEditmodel($id)
    {
        $user = User::where('id', $id)->first();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->repForTeam = $user->repForTeam;

        $this->edit_id = $id;



        //  dd($this->edit_id);

        $this->Editloaded = true;
        $this->closeModel = false;

    }
    public function selectUsers()
    {
        try {

            $this->Users = User::orderBy('created_at', 'DESC')->get();
        } catch (\Throwable $th) {
            session()->flash('message', 'please check the data');
        }
    }

    protected $rules = [
        'name' => ['required', 'min:2'],
        'email' => ['required', 'min:7', 'email'],
        'password' => ['required', 'min:8'],
        'repForTeam' => ['required'],
        'role' => ['required', 'min:2'],
    ];

    public function propertyReset()
    {

        $this->reset('name', 'email', 'repForTeam', 'role', 'password');

    }


    public function addUser()
    {
        $this->validate();

        if ($this->repForTeam == '') {
            $this->repForTeam = 'senior';
        }

        try {
            // $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');
            // $end_date = Carbon::createFromFormat('d/m/Y', $this->end_date)->format('Y-m-d');
            // if ($end_date->isBefore($date)){

            $Users = new User();
            $Users->name = $this->name;
            $Users->email = $this->email;
            $Users->repForTeam = $this->repForTeam;

            $Users->role = $this->role;

            $Users->password = bcrypt($this->password);

            $Users->save();
            $Users->assignRole($this->role);
            $this->propertyReset();

            $this->closeModel = true;

            Log::info($this->role);


            session()->flash('message', 'تمت اضافة العنصر بنجاح');
            // }else{session()->flash('error', 'الرجاء التأكد من التواريخ');}
        } catch (\Throwable $th) {
            session()->flash('error', 'الرجاء التأكد من البيانات');
        }
        $this->propertyReset();
        $this->loaded = false;


    }


    public function deleteuser($id)
    {
        $Users = User::where('id', $id)->first();
        if (!$Users) {
            return;
        }
        // try {

        $Users->delete();
        session()->flash('message', 'تمت حذف العنصر بنجاح');

        // }catch (\Throwable $th) {
        //     session()->flash('error', 'الرجاء التأكد من البيانات');
        // }

        $this->propertyReset();
        $this->selectUsers();
    }



    public function edituser($id)
    {
        $this->validate();

        if ($this->repForTeam == '') {
            $this->repForTeam = 'senior';
        }

        $Users = User::where('id', $id)->first();
        $Users->syncRoles([]);

        // Set the director_id and head_id properties to NULL if they are empty
        // $director_id = $this->director_id ?? null;
        // $head_id = $this->head_id ?? null;

        if (!$Users) {
            return;
        } else {
            try {
                // $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');
                // $end_date = Carbon::createFromFormat('d/m/Y', $this->end_date)->format('Y-m-d');



                $Users->name = $this->name;
                $Users->email = $this->email;
                $Users->repForTeam = $this->repForTeam;

                $Users->role = $this->role;

                $Users->password = bcrypt($this->password);

                $Users->update();
                $Users->assignRole($this->role);

                $this->propertyReset();


                $this->closeModel = true;

                session()->flash('message', 'تمت تعديل العنصر بنجاح');

            } catch (\Throwable $th) {
                session()->flash('error', 'الرجاء التأكد من البيانات');
            }
            $this->propertyReset();
            $this->Editloaded = false;

        }
    }


    public function edit()
    {


        // $this->validate();

        // if($this->repForTeam==''){
        //     $this->repForTeam='senior';
        //  }

        // $Users = User::where('id', $id)->first();
        // $Users->syncRoles([]);

        // // Set the director_id and head_id properties to NULL if they are empty
        // // $director_id = $this->director_id ?? null;
        // // $head_id = $this->head_id ?? null;

        // if (!$Users) {
        //     return;
        // } else {
        //     try {
        //     // $date = Carbon::createFromFormat('d/m/Y', $this->int_date)->format('Y-m-d');
        //     // $end_date = Carbon::createFromFormat('d/m/Y', $this->end_date)->format('Y-m-d');



        //     $Users->name = $this->name;
        //     $Users->email = $this->email;
        //     $Users->repForTeam = $this->repForTeam;

        //     $Users->role = $this->role;

        //     $Users->password = bcrypt($this->password);

        //     $Users->update();
        //     $this->propertyReset();

        //     // $Users->assignRole($this->role);

        //     $this->closeModel = true;

        //     session()->flash('message', 'تمت تعديل العنصر بنجاح');

        //     }catch (\Throwable $th) {
        //         session()->flash('error', 'الرجاء التأكد من البيانات');
        //     }
        //     $this->propertyReset();
        //     $this->Editloaded = false;

        // }

    }
}