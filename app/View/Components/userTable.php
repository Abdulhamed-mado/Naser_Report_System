<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class userTable extends Component
{
    public $Editloaded;

    /**
     * Create a new component instance.
     */
    public function __construct($Editloaded)
    {
        $this->Editloaded=$Editloaded;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $users=User::all();
        return view('components.user-table',[
'users'=>$users


        ]);
    }
}
