<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
{
                       
  $technologies = Technology::all()->pluck('id'); 

  for($i = 1;$i < 40; $i++){
    $project = Project::find($i);
    $project
    ->technologies()
    ->attach($faker->randomElements($technologies,3));
     }
  }
}