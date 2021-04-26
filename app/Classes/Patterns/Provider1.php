<?php


namespace App\Classes\Patterns;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class Provider1 implements ApiManagerInterface
{
    public function getData()
    {
        $provider = Http::get("http://www.mocky.io/v2/5d47f24c330000623fa3ebfa")->json();
        //var_dump($provider);
        $insertData = [];
        foreach ($provider as $pKey => $pVal){
            $q = DB::select("select * from todo WHERE title='".trim($pVal["id"])."'");
            if(!$q){
                $insertData[$pKey]["difficulty"]= $pVal["zorluk"];
                $insertData[$pKey]["duration"]= $pVal["sure"];
                $insertData[$pKey]["title"]= trim($pVal["id"]);
            }

        }

        if(count($insertData)==0){
            return false;
        }

        $insertDB = DB::table('todo')->insert($insertData);
        if(!$insertDB){
            return false;
        }


        return true;
    }
}
