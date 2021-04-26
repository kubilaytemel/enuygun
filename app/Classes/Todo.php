<?php


namespace App\Classes;


use App\Developers;

class Todo
{
    private static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Todo();
        }

        return self::$instance;
    }

    public function getTodo(){
        $developers = Developers::all();

        if (!$developers) {
            exit("Developers Not Found");
        }

        $devArr = [];

        foreach ($developers as $dKey => $dVal) {
            //echo $dVal->name;
            $devArr[$dKey]["developer"] = $dVal->name;
            $devArr[$dKey]["level"] = $dVal->level;
            $todos = \App\Todo::where('difficulty', $dVal->level)->orderBy("difficulty")->orderBy("duration")->get();

            $todoArr = [];
            foreach ($todos as $tKey => $tVal) {
                $todoArr[$tKey]["id"] = $tVal->id;
                $todoArr[$tKey]["title"] = $tVal->title;
                $todoArr[$tKey]["difficulty"] = $tVal->difficulty;
                $todoArr[$tKey]["duration"] = $tVal->duration;
            }

            $devArr[$dKey]["task"] = $todoArr;
        }

        return $devArr;

    }

    public function splitWeeks($devArr)
    {
        //Helper::printArray($devArr);
        $weeklyWorkLimit = 45;
        $res = [];
        foreach ($devArr as $dKey => $dVal) {
            $currentLimit = 0;
            $week = 1;
            if (!isset($res['week_' . $week])) {
                $res = ['week_' . $week => []];
            }


            $res["week_" . $week][$dVal["developer"]] = ["developer" => $dVal["developer"], 'jobs' => []];
            $duration = 0;
            //Helper::printArray($res["week_".$week]);
            $totalDevTask=0;

            $r_jobs = array_reverse($dVal['task']);

            while (count($r_jobs) > 0) {
                $task = array_pop($r_jobs);

                $currentLimit += $task["duration"];
                if ($currentLimit > $weeklyWorkLimit) {
                    $totalDevTask++;
                    $exceed = $currentLimit - $weeklyWorkLimit;
                    $res["week_" . $week][$dVal["developer"]]["total"] = $currentLimit - $exceed;
                    $task["duration"] = $task["duration"] - $exceed;
                    array_push($res['week_' . $week][$dVal["developer"]]['jobs'], $task);
                    $week++;
                    $res["week_" . $week][$dVal["developer"]] = ["developer" => $dVal["developer"], 'jobs' => []];

                    $newTask = $task;
                    array_push($res['week_' . $week][$dVal["developer"]]['jobs'], $newTask);
                    $totalDevTask++;
                    $currentLimit = $exceed;
                    //$res["week_" . $week][$dVal["developer"]]["total_dev_task"] = $totalDevTask;
                } else if ($currentLimit == $weeklyWorkLimit) {
                    $totalDevTask++;
                    $res["week_" . $week][$dVal["developer"]]["total"] = $currentLimit;
                    array_push($res['week_' . $week][$dVal["developer"]]['jobs'], $task);
                    $currentLimit = 0;
                    $week++;
                    $res["week_" . $week][$dVal["developer"]] = ["developer" => $dVal["developer"], 'jobs' => []];
                    //$res["week_" . $week][$dVal["developer"]]["total_dev_task"] = $totalDevTask;
                } else {
                    $totalDevTask++;
                    $res["week_" . $week][$dVal["developer"]]["total"] = $currentLimit;
                    array_push($res['week_' . $week][$dVal["developer"]]['jobs'], $task);
                    //$res["week_" . $week][$dVal["developer"]]["total_dev_task"] = $totalDevTask;
                }
                //echo $totalDevTask."<br>";
                //Helper::printArray($task);
                //$totalDevTask = 0;

            }


        }

        //Helper::printArray($res);
        return $res;

    }

}
