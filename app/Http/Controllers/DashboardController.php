<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developers;
use App\Todo;
class DashboardController extends Controller
{
    //

    public function index(){
        //Total Developers
        $developers = Developers::all();
        $data["totalDev"] = $developers->count();

        //Total Task
        $todo = Todo::all();
        $data["totalTodo"] = $todo->count();

        //Total Working Time
        $data["totalDuration"] = $todo->sum("duration");


        return view('dashboard', $data);
    }
}
