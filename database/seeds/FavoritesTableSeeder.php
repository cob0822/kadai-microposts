<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=30; $i++){
            DB::table("microposts")->insert([
                "user_id" => 8,
                "content" => "test".$i
            ]);
        }
    }
}
