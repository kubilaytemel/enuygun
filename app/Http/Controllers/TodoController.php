<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\Helpers\Helper;
use App\Classes\Todo as TodoTask;

class TodoController extends Controller
{

    public function index()
    {

        $todoTask = new TodoTask();
        $devArr = $todoTask->getTodo();


        $data["developerTask"] = $todoTask->splitWeeks($devArr);


        return view('todoWeek', $data);
    }

    public function todoList()
    {

        return view('todo');
    }

    public function developerList()
    {
        $todoTask = new TodoTask();
        $devArr = $todoTask->getTodo();

        $developerTask = $devArr;

        echo json_encode(array(
            'draw' => 1,
            "recordsTotal" => count($devArr),
            "recordsFiltered" => count($devArr),
            "data" => $developerTask
        ));
    }

}
