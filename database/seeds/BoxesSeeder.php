<?php

use Illuminate\Database\Seeder;
use App\Boxes;

class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            ["text" => ""],
            ["text" => "Dropee.com"],
            ["text" => ""],
            ["text" => "Build Trust"],
            ["text" => ""],
            ["text" => ""],
            ["text" => "SaaS enabled marketplace"],
            ["text" => ""],
            ["text" => "B2B Marketplace"],
            ["text" => ""],
            ["text" => ""],
            ["text" => ""],
            ["text" => ""],
            ["text" => ""],
            ["text" => ""],
            ["text" => "Provide Transparency"]
        ];

        Boxes::insert($insert);
    }
}

