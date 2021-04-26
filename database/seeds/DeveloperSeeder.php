<?php

use Illuminate\Database\Seeder;
use App\Developers;
class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();

        for($i=1; $i<=5; $i++) {
            Developers::create([
                'name' => 'Developer '.$i,
                'level' => $i
            ]);
        }
    }

}
