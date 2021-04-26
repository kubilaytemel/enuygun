<?php


namespace App\Classes\Patterns;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class Provider2 implements ApiManagerInterface
{
    public function getData()
    {
        $provider = Http::get("http://www.mocky.io/v2/5d47f235330000623fa3ebf7")->json();
        //var_dump($provider);
        $insertData = [];
        foreach ($provider as $pKey => $pVal) {
            foreach ($pVal as $psKey => $psVal) {
                //var_dump($psKey);
                $q = DB::select("select * from todo WHERE title='" . trim($psKey) . "'");
                if (!$q) {
                    $insertData[$pKey]["difficulty"] = $psVal["level"];
                    $insertData[$pKey]["duration"] = $psVal["estimated_duration"];
                    $insertData[$pKey]["title"] = trim($psKey);
                }
            }
        }

        if (count($insertData) == 0) {
            return false;
        }

        $insertDB = DB::table('todo')->insert($insertData);
        if(!$insertDB){
            return false;
        }

        //echo  json_encode($insertData);
        return true;

    }
}
