<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete all data.
        Project::truncate();

        //insert
        for($i=0;$i<25;$i++)
        {
            $project = Project::create();

            $project->title = "test";
            $project->description = "test";

            $project->save();

        }
        //
    }
}
