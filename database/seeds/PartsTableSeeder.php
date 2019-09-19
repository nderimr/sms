<?php

use Illuminate\Database\Seeder;
use App\Part;

class PartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Part::class,30)->create();
    }
}
