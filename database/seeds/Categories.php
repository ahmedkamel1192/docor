<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Critical care','Ear nose and throat','batn','3ezam','surgery'];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name' => ($cat),
            ]);
        }

    }
}
